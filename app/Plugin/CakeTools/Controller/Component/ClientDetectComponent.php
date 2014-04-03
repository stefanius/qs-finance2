<?php

class ClientDetectComponent extends Component
{
    public $name = 'ClientDetect';

    private $operatingSystems  =   array(
            'windows nt 6.3'     =>  'Windows 8.1',
            'windows nt 6.2'     =>  'Windows 8',
            'windows nt 6.1'     =>  'Windows 7',
            'windows nt 6.0'     =>  'Windows Vista',
            'windows nt 5.2'     =>  'Windows Server 2003/XP x64',
            'windows nt 5.1'     =>  'Windows XP',
            'windows xp'         =>  'Windows XP',
            'windows nt 5.0'     =>  'Windows 2000',
            'windows me'         =>  'Windows ME',
            'win98'              =>  'Windows 98',
            'win95'              =>  'Windows 95',
            'win16'              =>  'Windows 3.11',
            'macintosh'			 =>  'Mac OS X',
            'mac os x'			 =>  'Mac OS X',
            'macintosh|mac os x' =>  'Mac OS X',
            'mac_powerpc'        =>  'Mac OS 9',
            'linux'              =>  'Linux',
            'ubuntu'             =>  'Ubuntu (Linux)',
            'iphone'             =>  'iPhone',
            'ipod'               =>  'iPod',
            'ipad'               =>  'iPad',
            'android'            =>  'Android',
            'blackberry'         =>  'BlackBerry',
            'webos'              =>  'Mobile'
    );

    private $browserNames = array(
                'MSIE'	   => 'Internet Explorer',
                'Firefox'  => 'Mozilla Firefox',
                'Chrome'   => 'Google Chrome',
                'Safari'   => 'Apple Safari',
                'Opera'	   => 'Opera',
                'Netscape' => 'Netscape',
            );

    public function detect($useragent)
    {
        $OS = $this->detectOS($useragent);
        $browser = $this->detectBrowser($useragent);

        return array('os' => $OS, 'browser' => $browser);
    }

    private function detectOS($useragent)
    {
        $OS    =   "Unknown OS Platform";
           $foundagent = 'Unknown agent';

        foreach ($this->operatingSystems as $agent => $value) {
            if (preg_match('/'.$agent.'/i', $useragent)) {
                $OS    =   $value;
                $foundagent    =   $agent;
            }
        }

        return array('fullName' => $OS, 'shortName' => $foundagent);
    }

    private function detectBrowser($useragent)
    {
        $browserName = 'Unknown Browser';
        $foundAgent = 'Unknown Agent';

        foreach ($this->browserNames as $agent => $value) {

            if (preg_match('/'.$agent.'/i', $useragent)) {
                $browserName    =   $value;
                $foundAgent = $agent;
                break;
            }
        }

        $browserVersion = $this->detectBrowserVersion($agent, $useragent);

        return array(
                    'browserName'    => trim($browserName),
                    'agent'		     => trim($foundAgent),
                    'browserVersion' => trim($browserVersion),
                    'fullname'       => trim($browserName.' '.$browserVersion)
                );
    }

    private function detectBrowserVersion($agent, $useragent)
    {
        // finally get the correct version number
        $known = array('Version', $agent, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $useragent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent,"Version") < strripos($useragent,$agent)) {
                $version= $matches['version'][0];
            } else {
                $version= isset($matches['version'][1])?$matches['version'][1]:'';
            }
        } else {
            $version= $matches['version'][0];
        }

        // check if we have a number
        if ($version==null || $version=="") {
            $version="";
        }

        return $version;
    }
}
