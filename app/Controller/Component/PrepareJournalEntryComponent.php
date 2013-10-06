<?php

class PrepareJournalEntryComponent extends Component
{
	/**
	 * @param array $rawdata
	 */
	public function prepareSingleTransaction(array $rawdata){
		$preparedData = array();
		$preparedData[0]['bookyear_id'] = $rawdata[0]['bookyear_id'];
		$preparedData[0]['boekdatum'] = $rawdata[0]['boekdatum'];
		$preparedData[0]['omschrijving'] = $rawdata[0]['omschrijving'];
		$preparedData[0]['grootboek_id'] = $rawdata[0]['grootboek_id'];
		$preparedData[0]['debet'] = $rawdata[0]['debet'];
		$preparedData[0]['credit'] = $rawdata[0]['credit'];	

		$preparedData[1]['bookyear_id'] = $rawdata[0]['bookyear_id'];
		$preparedData[1]['boekdatum'] = $rawdata[0]['boekdatum'];
		$preparedData[1]['omschrijving'] = $rawdata[0]['omschrijving'];
		$preparedData[1]['grootboek_id'] = $rawdata[1]['grootboek_id'];
		$preparedData[1]['debet'] = $rawdata[0]['credit'];
		$preparedData[1]['credit'] = $rawdata[0]['debet'];	
		
		return $preparedData;
	}
	
	public function prepareBatchTransaction(){
	
	}
	
	public function generateHash(){
	
	}	
}