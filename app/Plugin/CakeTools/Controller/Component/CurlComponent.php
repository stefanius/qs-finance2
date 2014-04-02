<?php

class CurlComponent extends Component
{
    public $name = 'Curl';

    private $ch;
    
    private $curlOptions = array();
    
    public function addCurlOption($option, $value)
    {
    	$this->curlOptions[$option] = $value;
    }
    
    public function reset()
    {
    	$this->curlOptions = array();
    	$this->addCurlOption(CURLOPT_USERAGENT, "MozillaXYZ/1.0");
    	$this->addCurlOption(CURLOPT_HEADER, 0);
    	$this->addCurlOption(CURLOPT_RETURNTRANSFER, true);
    	$this->addCurlOption(CURLOPT_TIMEOUT, 10);
    }
    
    public function execute($url)
    {	
    	// is cURL installed yet?
    	if (!function_exists('curl_init')){
    		die('Sorry cURL is not installed!');
    	}
    	 
    	// OK cool - then let's create a new cURL resource handle
    	$this->ch = curl_init();
    	 
    	// Now set some options (most are optional)
    	 
    	// Set URL to download
    	curl_setopt($this->ch, CURLOPT_URL, $url);

    	foreach($this->curlOptions as $key=>$value){
    		curl_setopt($this->ch, $key, $value);
    	}
    	 
    	// Download the given URL, and return output
    	$output = curl_exec($this->ch);
    	 
    	// Close the cURL resource, and free system resources
    	curl_close($this->ch);    

    	return $output;
    }
}
