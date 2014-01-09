<?php
class SearchController extends AppController
{
	public $helpers = array('Form', 'Html', 'Number',  'Balans');
	public $components = array('RequestHandler');
	public $uses = array();

	/**
	 * 
	 * @param Object $request - includes:
	 *              fields[] - as array of returned fields
	 *              key - as string of JQuery key (fieldname)
	 *              display - as JQuery display key (fieldname)
	 *              termfield - as string. Fieldname where the term-value must match
	 *              term - search value
	 *              
	 * @param string $modelprefix
	 * @return array
	 */
	private function generateParams(CakeRequest $request, $modelprefix){

		$params = array();
		$params = $request->query;

		foreach($params['fields'] as $key=>$value){
			unset($params['fields'][$key]);
			if(count($request->query['fields'] ) == 1){
				$params['fields'][] = 'DISTINCT ('.$modelprefix.'.'.$value.')';
			}else{
				$params['fields'][] = $modelprefix.'.'.$value;
			}
			
		}

		if(isset($params['label'])){
			$params['label'] = $modelprefix.'.'.$params['label'];
		}

		if(isset($params['value'])){
			$params['value'] = $modelprefix.'.'.$params['value'];
		}

		if(isset($params['termfield'])){
			$params['termfield'] = $modelprefix.'.'.$params['termfield'];
		}

		return $params;
	}

	public function grootboek() {
		$this->loadModel('Grootboek');
		$params = $this->generateParams($this->request, 'Grootboek');

		$rawresponse = $this->Grootboek->find('all',
				array('conditions' => array($params['termfield'].' LIKE '=>'%'.$params['term'].'%'),
						'fields'=> $params['fields']));

		$response = array();

		foreach($rawresponse as $grootboek){
			$value = str_replace ( 'Grootboek.' ,'' ,$params['value'] );
			$label = str_replace ( 'Grootboek.' ,'' ,$params['label'] );
			
			$gb =  $grootboek['Grootboek'];
			$gb['value'] = $gb[$value];
			$gb['label'] = $gb[$label];
			$response[] = $gb ;

		}
		$this->set(compact('response'));
		$this->set('_serialize', 'response');
	}

	public function journaal() {
		$this->loadModel('Calculation');
		$params = $this->generateParams($this->request, 'Calculation');
	
		$rawresponse = $this->Calculation->find('all',
				array('conditions' => array($params['termfield'].' LIKE '=>'%'.$params['term'].'%'),
						'fields'=> 'DISTINCT '.$params['fields']));
	
		$response = array();
	
		foreach($rawresponse as $calculation){
			$value = str_replace ( 'Calculation.' ,'' ,$params['value'] );
			$label = str_replace ( 'Calculation.' ,'' ,$params['label'] );
				
			$gb =  $calculation['Calculation'];
			$gb['value'] = $gb[$value];
			$gb['label'] = $gb[$label];
			$response[] = $gb ;
	
		}
		$this->set(compact('response'));
		$this->set('_serialize', 'response');
	}


}