<?php
App::uses('Component', 'Controller');

//{"status":"success","country":"Netherlands","countryCode":"NL","region":"","regionName":"","city":"","zip":"","lat":"52.5","lon":"5.75","timezone":"Europe\/Amsterdam","isp":"Sanoma Digital the Netherlands b.v.","org":"Sanoma Digital bv dialup pools","as":"AS23148 Terremark","query":"62.69.166.254"}

class GeoIpComponent extends Component
{
    public $components = array('CakeTools.Curl');

    public $name = 'GeoIp';

    private $localIps = ['192.168.', '192.16.', '10.0.'];

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
        foreach($this->localIps as $localIp){
            if (strpos($ip, $localIp) !== false) {
                return ['country' => 'Local Area Network', 'countryCode' => 'LAN', 'city' => 'Local Area Network', 'regionName' => 'Local Area Network'];
            }
        }

        $url = trim($this->baseUrl).'/'.$ip;

        return json_decode($this->Curl->execute($url));
    }
}
