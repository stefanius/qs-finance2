<?php
App::uses('Component', 'Controller');

class SessiondataComponent extends Component {
// the other component your component uses
    public $components = array('CakeTools.ClientDetect', 'CakeTools.GeoIp');

    protected $useragent;
    protected $operatingSystem;
    protected $browser;
    protected $fullGeoLocation;

    public function initialize(Controller $controller)
    {
        $this->Sessiondata = ClassRegistry::init('CakeTools.Sessiondata');
        $this->useragent = $_SERVER['HTTP_USER_AGENT'];

        $detect = $this->ClientDetect->detect($this->useragent);
        $this->operatingSystem = $detect['os'] ;
        $this->browser = $detect['browser'];
        $this->fullGeoLocation = $this->GeoIp->execute($this->getIp());
    }

    public function getOperatingSystem()
    {
        return $this->operatingSystem['fullName'];
    }

    public function getBrowserName()
    {
        return $this->browser['browserName'];
    }

    public function getBrowserVersion()
    {
        return $this->browser['browserVersion'];
    }

    public function getFullBrowserName()
    {
        return $this->browser['fullname'];
    }

    public function getIp()
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    public function getBrowserLanguage()
    {
        return substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
    }

    public function getUseragent()
    {
        return $this->useragent;
    }

    public function getGeoCityName()
    {
        return $this->fullGeoLocation['city'];
    }

    public function getGeoRegionName()
    {
        return $this->fullGeoLocation['regionName'];
    }

    public function getGeoCountry()
    {
        return $this->fullGeoLocation['country'];
    }

    public function getSessionTimeout()
    {
        return Configure::read('Session.timeout') * 60;
    }

    public function getTimeSessionExpires($format = "Y-m-d H:i:s"){
        $timeout = $this->getSessionTimeout();
        $expired = strtotime(date($format)) + $timeout;

        return date($format, $expired);
    }

    public function getCakeSessionData()
    {
       return Configure::read('Session');
    }

    public function save($user_id)
    {
        $sessiondata = [
            'useragent'      => $this->getUseragent(),
            'data'           => json_encode($this->getCakeSessionData()),
            'os'             => $this->getOperatingSystem(),
            'user_id'        => $user_id,
            'ip'             => $this->getIp(),
            'browser'        => $this->getBrowserName(),
            'browserversion' => $this->getBrowserVersion(),
            'city'           => $this->getGeoCityName(),
            'country'        => $this->getGeoCountry(),
            'state'          => $this->getGeoRegionName(),
            'expires'        => $this->getTimeSessionExpires(),
        ];

        $this->Sessiondata->create();
        $this->Sessiondata->set($sessiondata);
        $this->Sessiondata->save();

        Configure::write('Session.sessiondata_id', $this->Sessiondata->getId());
    }

    public function update()
    {
        $cakeSessionData = $this->getCakeSessionData();
        $this->Sessiondata->id=$cakeSessionData['sessiondata_id'];
        $this->Sessiondata->saveField("expires", $this->getTimeSessionExpires());
    }
}