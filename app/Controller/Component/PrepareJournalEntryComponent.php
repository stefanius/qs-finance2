<?php

class PrepareJournalEntryComponent extends Component
{
	public $components = array('Auth');
	/**
	 * @param array $rawdata
	 */
	public function prepareSingleTransaction(array $rawdata){
		
		$hash = $this->generateHash();
		$preparedData = array();
		
		$explodedDate = explode('-', $rawdata[0]['boekdatum']);
		$rawdata[0]['boekdatum'] = $explodedDate[2].'-'.$explodedDate[1].'-'.$explodedDate[0];		
		
		$preparedData[0]['bookyear_id'] = $rawdata[0]['bookyear_id'];
		$preparedData[0]['boekdatum'] = $rawdata[0]['boekdatum'];
		$preparedData[0]['omschrijving'] = $rawdata[0]['omschrijving'];
		$preparedData[0]['grootboek_id'] = $rawdata[0]['grootboek_id'];
		$preparedData[0]['user_id'] = $this->Auth->user('id');
		$preparedData[0]['hash'] = $hash; 
		$preparedData[0]['debet'] = $rawdata[0]['debet'];
		$preparedData[0]['credit'] = $rawdata[0]['credit'];	

		$preparedData[1]['bookyear_id'] = $rawdata[0]['bookyear_id'];
		$preparedData[1]['boekdatum'] = $rawdata[0]['boekdatum'];
		$preparedData[1]['omschrijving'] = $rawdata[0]['omschrijving'];
		$preparedData[1]['grootboek_id'] = $rawdata[1]['grootboek_id'];
		$preparedData[1]['user_id'] = $this->Auth->user('id');
		$preparedData[1]['hash'] = $hash;
		$preparedData[1]['debet'] = $rawdata[0]['credit'];
		$preparedData[1]['credit'] = $rawdata[0]['debet'];	
		
		return $preparedData;
	}
	
	public function prepareBatchTransaction($calculations, $bookyear, $ledger){
		//$ledger==english translation from Grootboek
		$preparedData = array();
		$hash = $this->generateHash();
		$i=0;
		foreach ($calculations as $calculation) {
			if($calculation['process']==1){
				/* Gegevens bankpost van de source-csv */
				$preparedData[$i]['bookyear_id'] = $bookyear['Bookyear']['id'];
				$preparedData[$i]['boekdatum'] = $calculation['boekdatum'];
				$preparedData[$i]['omschrijving'] = $calculation['omschrijving'];
				$preparedData[$i]['grootboek_id'] = $ledger['Grootboek']['id'];
				$preparedData[$i]['debet'] = $calculation['debet'];
				$preparedData[$i]['credit'] = $calculation['credit'];
				$preparedData[$i]['hash'] =$hash;
				$i++;
		
				/* Gegevens grootboek / balanspost / resultaatpost van de doel-post */
				$preparedData[$i]['bookyear_id'] = $bookyear['Bookyear']['id'];
				$preparedData[$i]['boekdatum'] = $calculation['boekdatum'];
				$preparedData[$i]['omschrijving'] = $calculation['omschrijving'];
				$preparedData[$i]['grootboek_id'] = $calculation['grootboek_id'];
				$preparedData[$i]['debet'] = $calculation['credit']; //DEBET from source-csv is CREDIT from target
				$preparedData[$i]['credit'] = $calculation['debet']; //CREDIT from source-csv is DEBET from target
				$preparedData[$i]['hash'] =$hash;
				$i++;
			}
		}
		return $preparedData;	
	}
	
	private function generateHash(){
			
		return md5(String::uuid());	
	}	
}