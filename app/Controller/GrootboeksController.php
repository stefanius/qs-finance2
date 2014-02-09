<?php
class GrootboeksController extends AppController
{
    public $name = 'Grootboeks';
    public $helpers = array('Balans');
    
    public function index()
    {
    	$usedGrootboeks = array();
        $conditions = array(
        		'fields' => array('DISTINCT (Calculation.grootboek_id) AS grootboek_id')
        );    
        
        $this->Grootboek->recursive = 0;
        $rawDistinctList = $this->Grootboek->Calculation->find('all',$conditions);
        foreach($rawDistinctList as $distintItem){
        	$usedGrootboeks[] = $distintItem['Calculation']['grootboek_id'];
        }

        $this->set('grootboeks', $this->Grootboek->getPosten());
        $this->set('usedGrootboeks', $usedGrootboeks);
    }

    public function view($key = null)
    {
        if (!$key) {
            $this->Session->setFlash(__('Invalid grootboek'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('grootboek', $this->Grootboek->get($key));
    }

    public function add()
    {
        if (!empty($this->request->data)) {
        	$checkDuplicate = $this->Grootboek->get($this->request->data['Grootboek']['nummer']);
        	
        	if(empty($checkDuplicate)){
	        	if($this->request->data['Grootboek']['rektype'] == 0){
	        		$this->request->data['Grootboek']['debetcredit']='debet';
	        		$this->request->data['Grootboek']['winstverlies']=0;
	        	}elseif($this->request->data['Grootboek']['rektype'] == 1){
	        		$this->request->data['Grootboek']['debetcredit']='credit';
	        		$this->request->data['Grootboek']['winstverlies']=0;        		
	        	}elseif($this->request->data['Grootboek']['rektype'] == 2){
	        		$this->request->data['Grootboek']['debetcredit']='credit';
	        		$this->request->data['Grootboek']['winstverlies']=1;        		
	        	}
	        	
	        	unset($this->request->data['Grootboek']['rektype']);
        		
        		$this->Grootboek->create();
        		
        		if ($this->Grootboek->save($this->request->data)) {
        			$this->Session->setFlash(__('Het grootboek is succesvol opgeslagen.'), 'success');
        			$this->redirect(array('action' => 'index'));
        		} else {
        			$this->Session->setFlash(__('Het grootboek kon niet worden opgeslagen.'), 'danger');
        		}        		
        	}else{
        		$this->Session->setFlash(__('Er bestaat al een grootboek met nummer '.$this->request->data['Grootboek']['nummer'].'. Kies een ander nummer.'), 'danger');
        	}
        }
    }

    public function edit($key = null)
    {
        if (!$key && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid grootboek'));
            $this->redirect(array('action' => 'index'));
        }
        
        if (!empty($this->request->data)) {
        	if($this->request->data['Grootboek']['rektype'] == 0){
        		$this->request->data['Grootboek']['debetcredit']='debet';
        		$this->request->data['Grootboek']['winstverlies']=0;
        	}elseif($this->request->data['Grootboek']['rektype'] == 1){
        		$this->request->data['Grootboek']['debetcredit']='credit';
        		$this->request->data['Grootboek']['winstverlies']=0;        		
        	}elseif($this->request->data['Grootboek']['rektype'] == 2){
        		$this->request->data['Grootboek']['debetcredit']='credit';
        		$this->request->data['Grootboek']['winstverlies']=1;        		
        	}
        	
        	unset($this->request->data['Grootboek']['rektype']);
        	
            if ($this->Grootboek->save($this->request->data)) {
                $this->Session->setFlash(__('Het grootboek is succesvol opgeslagen.'), 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Het grootboek kon niet worden opgeslagen.'), 'danger');
            }
        }
        
        if (empty($this->request->data)) {
            $this->request->data = $this->Grootboek->get($key);
        }
    }

    public function delete($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for grootboek'));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Grootboek->delete($id)) {
            $this->Session->setFlash(__('Grootboek deleted'));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('Grootboek was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function open($grootboek_key=null)
    {
    	$bookyear = array();
        $bookyear['Bookyear'] = $this->checkSessionHasBookyear();
        if($grootboek_key==null){
        	$grootboek_key = $this->request->params['rekeningnummer'];
        }
        $grootboek = $this->Grootboek->getSaldi($bookyear['Bookyear']['id'], $grootboek_key);
        
        $this->set(compact('grootboek', 'bookyear'));
    }

    public function overzicht($type)
    {
        // 0 = balans, 1 = resultaat
        $posten =  $this->Grootboek->getPosten($type);
        $bookyear['Bookyear'] = $this->checkSessionHasBookyear();
        $overzicht[0] = "";
        $i=0;
        foreach ($posten as $post) {
            $saldi = $this->Grootboek->getSaldi($bookyear['Bookyear']['id'], $post['Grootboek']['id']);
            $overzicht[$i] = $saldi;
            $i++;
        }
        $this->set(compact('overzicht', 'bookyear'));
    }
    
    public function search($field=null, $term=null) {
		
    	if($term==null && isset($this->request->query['term'])){
    		$term=$this->request->query['term'];
		}
    	if($field == null || $term == null){
    		$rawresponse = $this->Grootboek->find('all');
    	}else{
    		$rawresponse = $this->Grootboek->find('all', 
    				array('conditions' => array('Grootboek.'.$field.' LIKE '=>'%'.$term.'%'), 
    						   'fields'=> array('Grootboek.'.$field, 'Grootboek.nummer','Grootboek.display_omschrijving' )));
    	}
		$response = array();
		
		foreach($rawresponse as $grootboek){
			$response[] = $grootboek['Grootboek']['nummer'];
		}
    	$this->set(compact('response'));
    	$this->set('_serialize', 'response');    	
    	
    	
    //	exit( json_encode($this->Grootboek->find('list', array('conditions' => array()) ) ));
    }    
}
