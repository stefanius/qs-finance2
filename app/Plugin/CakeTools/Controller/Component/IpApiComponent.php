<?php
App::uses('Component', 'Controller');

class IpApiComponent extends Component
{
    public $components = array('CakeTools.Curl');

    public $name = 'IpApi';

    private $baseUrl = 'http://ip-api.com/json/';

    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function execute($ip)
    {
        $url = trim($this->$baseUrl).'/'.$ip;

        return json_decode($this->Curl->execute($url));
    }
}
