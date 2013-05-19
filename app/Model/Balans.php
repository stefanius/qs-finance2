<?php
class Balans extends AppModel {
	//var $name = 'Balans';
	var $useTable = false;

	var $hasMany = array(
		'Calculation' => array(
			'className' => 'Calculation',
			'foreignKey' => 'grootboek_id',
		),
		
		'Bookyear' => array(
			'className' => 'Bookyear',
			'foreignKey' => 'bookyear_id',
		),		

		'Grootboek' => array(
			'className' => 'Grootboek',
			'foreignKey' => 'grootboek_id',
		)
	);
	
	function formatBalans($balans){
		$zijde = 'geen';
		if($balans['debet']['aantalrij'] < $balans['credit']['aantalrij']){
			$extrarij = $balans['credit']['aantalrij'] - $balans['debet']['aantalrij'];
			$zijde = 'debet';
		}elseif($balans['debet']['aantalrij'] > $balans['credit']['aantalrij']){
			$extrarij = $balans['debet']['aantalrij'] - $balans['credit']['aantalrij'];
			$zijde = 'credit';
		}
		
		for($i=0;$i<$extrarij;$i++){
			$gb['Grootboek']['nummer'] = 0;
			$gb['Grootboek']['omschrijving'] = '.';
			$gb['Bedrag']['debet']=0;
			$gb['Bedrag']['credit']=0;
			$gb['Bedrag']['saldo']=0;
			$balans[$zijde]['posten'][90000+$i] = $gb;
		}
		
		return $balans;
	}
	
	function openBalans($bookyear_key,$beginbalans=null){
		$bookyear = $this->Bookyear->get($bookyear_key);
		$balansposten = $this->Grootboek->getPosten(0); //0=Balansposten, 1=Resultaatposten.
		$balans = $this->berekenbalans($balansposten,$bookyear, $beginbalans);
		return $balans;
	}
	
	function openKolomBalans($bookyear_key){
		$bookyear = $this->Bookyear->get($bookyear_key);
		$balansposten = $this->Grootboek->getPosten(0); //0=Balansposten, 1=Resultaatposten.
		$resultaatposten =$this->Grootboek->getPosten(1);
		$kolombalans['beginbalans'] = $this->berekenbalans($balansposten, $bookyear,1); //1=beginbalans
		$kolombalans['proefbalans'] =$this->berekenbalans($balansposten, $bookyear);
		$kolombalans['proefbalans'] +=$this->berekenbalans($resultaatposten, $bookyear);
		$kolombalans['saldibalans'] = $kolombalans['proefbalans'];
		$kolombalans['winstverlies'] = $this->berekenbalans($resultaatposten, $bookyear);
		$kolombalans['winstverlies']['debet']['posten'][9999999999] = "BLAAT"; //een leeg debet item.
		$kolombalans['eindbalans'] = $this->berekenbalans($balansposten, $bookyear);
                $kolombalans['posten']['balans'] =$balansposten;
                $kolombalans['posten']['resultaat'] =$resultaatposten;
		
		//$kolombalans['beginbaans']['ev'] = $kolombalans['beginbalans']['debet']['totaal'] - $kolombalans['beginbalans']['credit']['totaal'];
		//$kolombalans['saldibalans']['ev'] = $kolombalans['saldibalans']['Bedrag']['debet'] - $kolombalans['saldibalans']['Bedrag']['credit'];
		//$kolombalans['eindbalans']['ev'] = $kolombalans['eindbalans']['debet']['totaal'] - $kolombalans['eindbalans']['debet']['totaal'];
		//$kolombalans['proefbalans']['ev'] = $kolombalans['proefbalans']['Bedrag']['debet'] - $kolombalans['proefbalans']['Bedrag']['credit'];
		
		$tmp['debet']=0;
		$tmp['credit']=0;
		/*
		foreach ($kolombalans['saldibalans'] as $key => $val) {
			if(isset($val['Grootboek'])){
				$kolombalans['saldibalans'][$key]['Bedrag']['debet']=0;
				$kolombalans['saldibalans'][$key]['Bedrag']['credit']=0;
				$kolombalans['saldibalans'][$key]['Bedrag'][$val['Grootboek']['debetcredit']] = $kolombalans['saldibalans'][$key]['Bedrag']['saldo'];
				$tmp[$kolombalans[$val['Grootboek']['debetcredit']]]+= $kolombalans['saldibalans'][$key]['Bedrag'][$val['Grootboek']['debetcredit']];
			}		}
		$kolombalans['saldibalans']['Bedrag'] = $tmp;*/
		return $kolombalans;		
	}
	
	function berekenbalans($balansposten,$bookyear, $beginbalans=null){
		$balans['debet']['aantalrij']=0;
		$balans['credit']['aantalrij']=0;
		$balans['debet']['totaal']=0;
		$balans['credit']['totaal']=0;
		foreach($balansposten as $balanspost){		
			$gb = $this->Grootboek->getSaldi($bookyear['Bookyear']['id'], $balanspost['Grootboek']['id'],$beginbalans);		
			$balans[$balanspost['Grootboek']['debetcredit']]['posten'][$balanspost['Grootboek']['nummer']] = $gb;
			$balans[$balanspost['Grootboek']['debetcredit']]['aantalrij']++;
			$balans[$balanspost['Grootboek']['debetcredit']]['totaal']+=$gb['Bedrag']['saldo'];
		}
		$balans['ev'] = $balans['debet']['totaal'] - $balans['credit']['totaal'];
		$balans['credit']['totaal'] = $balans['credit']['totaal'] + $balans['ev'];
		$balans['credit']['aantalrij']++; //Er wordt later een statische rij 'Eigen Vermogen' toegevoegd.
		$balans['Bookyear'] = $bookyear['Bookyear'];
		return $balans;
	}

	function newbalans($oldbookyear_key, $newbookyear_key){
		$oldbookyear = $this->Bookyear->get($oldbookyear_key);
		$newbookyear = $this->Bookyear->get($newbookyear_key);
		//Haal alle balansposten op
		$balansposten = $this->Grootboek->getPosten(0); //0=Balansposten, 1=Resultaatposten.
		//Bereken de saldi van de voorgaande balans (boekjaar)
		$oude_balans = $this->berekenbalans($balansposten, $oldbookyear);

		//Schrijf de nieuwe journaalposten weg als 'Van Balans'
		//Eerst de posten aan de Debet-zijde en later van de Credit-zijde
		
		//Zet de nieuwe balans voor de debet en creditzijde.
		$this->setbeginbalans($oude_balans, 'debet', $newbookyear);
		$this->setbeginbalans($oude_balans , 'credit', $newbookyear);
	
		$this->Bookyear->closebookyear($oldbookyear);
	}
	
	function setbeginbalans($balansposten, $side, $newbookyear_data){
		foreach($balansposten[$side]['posten'] as $a){
			$journaal['grootboek_id'] = $a['Grootboek']['id'];
			$journaal['bookyear_id'] = $newbookyear_data['Bookyear']['id'];
			$journaal['boekingstuk'] = "BEGINBALANS-".$newbookyear_data['Bookyear']['omschrijving'];
			$journaal['omschrijving'] = "Van beginbalans";
			$journaal['boekdatum'] = $newbookyear_data['Bookyear']['startdatum'];
			$journaal['beginbalans'] = 1;
			$journaal[$side] = $a['Bedrag']['saldo'];
			$this->Calculation->create();
			$this->Calculation->save($journaal);
		}
	}
}
?>