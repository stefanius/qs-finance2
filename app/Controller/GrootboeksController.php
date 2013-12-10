<?php
class GrootboeksController extends AppController
{
    public $name = 'Grootboeks';
    public $helpers = array('Balans');
    
    public function index()
    {
        $this->Grootboek->recursive = 0;
        $this->set('grootboeks', $this->Grootboek->getPosten());
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
            if ($this->request->data['Grootboek']['debetcredit']=='result') {
                $this->request->data['Grootboek']['debetcredit']='credit';
                $this->request->data['Grootboek']['winstverlies']=1;
            } else {
                $this->request->data['winstverlies']=0;
            }

            $this->Grootboek->create();
            if ($this->Grootboek->save($this->request->data)) {
                $this->Session->setFlash(__('The grootboek has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The grootboek could not be saved. Please, try again.'));
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
            if ($this->Grootboek->save($this->request->data)) {
                $this->Session->setFlash(__('The grootboek has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The grootboek could not be saved. Please, try again.'));
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

    public function overzicht($bookyear_key, $type)
    {
        // 0 = balans, 1 = resultaat
        $posten =  $this->Grootboek->getPosten($type);
        $bookyear = $this->Grootboek->Bookyear->get($bookyear_key);
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
