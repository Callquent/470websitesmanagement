<?php

/*
 * This file is part of the PHPWhois package.
 *
 * (c) Peter Kokot <peterkokot@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
include('Validator.php');
include('Server.php');

class Whois
{
    public $domain;

    public $tld;

    public $ip = null;

    /**
     * Constructor.
     *
     * @param string $domain Domain name
     */
    public function __construct($domain = "")
    {
        $this->domain = $this->clean($domain);
        $validator = new Validator();

        // check if domain is valid
        if ($validator->validateDomain($this->domain)) {
            $domainParts = explode(".", $this->domain);
            $this->tld = strtolower(array_pop($domainParts));
        } else {
            return ('Domain invalid.');
        }
    }

    /**
     * Cleans domain name of empty spaces, www, http and https.
     *
     * @param string $domain Domain name
     *
     * @return string
     */
    public function clean($domain)
    {
        $domain = trim($domain);
        $domain = preg_replace('#^https?://#', '', $domain);
        if (substr(strtolower($domain), 0, 4) == "www.") $domain = substr($domain, 4);

        return $domain;
    }

    /**
     * Looks up the current domain or IP.
     * 
     * @return string Content of whois lookup.
     */
    public function lookup()
    {
        if ($this->domain) {
            $string_utf8 = $this->lookupDomain($this->domain);
            $result[] = $string_utf8;


            switch ($this->tld) // on indique sur quelle variable on travaille
            { 
                case 'com':
                case 'net':
                preg_match_all('/Creation\sDate:\s(.*)T.*Expiration\sDate:\s(.*)T.*Registrar:(.*)Registrar/siU', $string_utf8, $data);
                    if (isset($data[1][0]) && isset($data[2][0])) {
                        $result[]=trim($data[1][0]);
                        $result[]=trim($data[2][0]);
                        $result[]=trim($data[3][0]);
                    } else {
                        $result="";
                    }
                break;

                case 'org':
                case 'paris':
                case 'ovh':
                    preg_match_all('/Creation\sDate:\s(.*)T.*Registry\sExpiry\sDate:\s(.*)T.*Sponsoring\sRegistrar:(.*)Sponsoring\sRegistrar/siU', $string_utf8, $data);
                    if (isset($data[1][0]) && isset($data[2][0])) {
                        $result[]=trim($data[1][0]);
                        $result[]=trim($data[2][0]);
                        $result[]=trim($data[3][0]);
                    } else {
                        $result="";
                    }
                break;
                
                case 'uk':
                    preg_match_all('/Registrar:(.*)URL.*Registered\son:\s(.*)\sExpiry\sDate:\s(.*)L/siU', $string_utf8, $data);
                    if (isset($data[2][0]) && isset($data[3][0])) {
                        $result[]=trim($data[2][0]);
                        $result[]=trim($data[3][0]);
                        $result[]=trim($data[1][0]);
                    } else {
                        $result="";
                    }
                break;
                
                case 'ie':
                    preg_match_all('/registration:(.*)renewal:(.*)holder-type:/siU', $string_utf8, $data);
                    if (isset($data[1][0]) && isset($data[2][0])) {
                        $result[]=trim($data[1][0]);
                        $result[]=trim($data[2][0]);
                        $result[]=null;
                    } else {
                        $result="";
                    }
                break;
                
                case 'it':
                    preg_match_all('/Created:(.*-..-..).*Expire\sDate:\s(.*)\sRegistrant.*Registrar.*Organization:(.*)Name/siU', $string_utf8, $data);
                    if (isset($data[1][0]) && isset($data[2][0])) {
                        $result[]=trim($data[1][0]);
                        $result[]=trim($data[2][0]);
                        $result[]=trim($data[3][0]);
                    } else {
                        $result="";
                    }
                break;
                
                case 'fr':
                    preg_match_all('/registrar:\s(.*)\sExpiry\sDate:\s(.*)\screated:\s(.*)\slast-update/siU', $string_utf8, $data);
                    if (isset($data[3][0]) && isset($data[2][0])) {
                        $result[]=trim($data[3][0]);
                        $result[]=trim($data[2][0]);
                        $result[]=trim($data[1][0]);
                    } else {
                        $result="";
                    }
                break;
                
                case 'pt':
                    preg_match_all('/Creation\sDate\s\(dd\/mm\/yyyy\):\s(.*)Data.*Expiration\sDate\s\(dd\/mm\/yyyy\):\s(.*)Estado/siU', $string_utf8, $data);
                    if (isset($data[3][0]) && isset($data[2][0])) {
                        $result[]=trim($data[3][0]);
                        $result[]=trim($data[2][0]);
                        $result[]=trim($data[1][0]);
                    } else {
                        $result="";
                    }
                break;

                case 'se':
                    preg_match_all('/created:(.*)modified:.*expires:(.*)transferred:.*registrar:(.*)$/siU', $string_utf8, $data);
                    if (isset($data[1][0]) && isset($data[2][0])) {
                        $result[]=trim($data[1][0]);
                        $result[]=trim($data[2][0]);
                        $result[]=trim($data[3][0]);
                    } else {
                        $result="";
                    }
                break;

                case 'fi':
                    preg_match_all('/created:(.*)modified:.*expires:(.*)nserver/siU', $string_utf8, $data);
                    if (isset($data[1][0]) && isset($data[2][0])) {
                        $result[]=trim($data[1][0]);
                        $result[]=trim($data[2][0]);
                        $result[]=null;
                    } else {
                        $result="";
                    }
                break;

                case 'dk':
                    preg_match_all('/Registered:(.*)Expires:(.*)Registration\speriod:/siU', $string_utf8, $data);
                    if (isset($data[1][0]) && isset($data[2][0])) {
                        $result[]=trim($data[1][0]);
                        $result[]=trim($data[2][0]);
                        $result[]=null;
                    } else {
                        $result="";
                    }
                break;

                case 'ru':
                    preg_match_all('/registrar:\s(.*)admin-contact.*created:\s(.*)\spaid-till:\s(.*)\sfree-date/siU', $string_utf8, $data);
                    if (isset($data[3][0]) && isset($data[2][0])) {
                        $result[]=trim($data[2][0]);
                        $result[]=trim($data[3][0]);
                        $result[]=trim($data[1][0]);
                    } else {
                        $result="";
                    }
                break;

                case 'pl':
                    preg_match_all('/created:(.*\...\...).*renewal\sdate:(.*\...\...).*REGISTRAR:\r\n(.*)\r\n.*/siU', $string_utf8, $data);
                    if (isset($data[1][0]) && isset($data[2][0])) {
                        $result[]=trim($data[1][0]);
                        $result[]=trim($data[2][0]);
                        $result[]=trim($data[3][0]);
                        
                    } else {
                        $result="";
                    }
                break;

                case 'jp':
                    preg_match_all('/\[登録年月日\](.*)\[有効期限\](.*)\[状態\]/siU', $string_utf8, $data);
                    if (isset($data[1][0]) && isset($data[2][0])) {
                        $result[]=trim($data[1][0]);
                        $result[]=trim($data[2][0]);
                        $result[]=null;
                    } else {
                        $result="";
                    }
                break;

                case 'cn':
                    preg_match_all('/Sponsoring\sRegistrar:\s(.*)Name\sServer.*Registration\sTime:\s(.*)Expiration\sTime:\s(.*)DNSSEC/siU', $string_utf8, $data);
                    if (isset($data[2][0]) && isset($data[3][0])) {
                        $result[]=trim($data[2][0]);
                        $result[]=trim($data[3][0]);
                        $result[]=trim($data[1][0]);
                    } else {
                        $result="";
                    }
                break;
                
                default:
                    $result="";
            }
        }

        return $result;
    }

    /**
     * Domain lookup.
     *
     * @param string @domain Domain name
     *
     * @return string Domain lookup results.
     */
    public function lookupDomain($domain)
    {
        $serverObj = new Server();
        $server = $serverObj->getServerByTld($this->tld);
        if (!$server) {
            throw new Exception("Error: No appropriate Whois server found for $domain domain!");
        }
        $result = $this->queryServer($server, $domain);
        if (!$result) {
            /*throw new Exception("Error: No results retrieved from $server server for $domain domain!");*/
        } else {
            while (strpos($result, "Whois Server:") !== false) {
                preg_match("/Whois Server: (.*)/", $result, $matches);
                $secondary = $matches[1];
                if ($secondary) {
                    $result = $this->queryServer($secondary, $domain);
                    $server = $secondary;
                }
            }
        }
        return $result;
    }
    public function queryServer($server, $domain)
    {
        $port = 43;
        $timeout = 10;
        $fp = @fsockopen($server, $port, $errno, $errstr, $timeout);
        if ( !$fp ) {
            throw new Exception("Socket Error " . $errno . " - " . $errstr);
        }
        // if($server == "whois.verisign-grs.com") $domain = "=".$domain; // whois.verisign-grs.com requires the equals sign ("=") or it returns any result containing the searched string.
        fwrite($fp, $domain ."\r\n");
        $out = "";
        while (!feof($fp)) {
            $out .= fgets($fp);
        }
        fclose($fp);

        $res = $out;
        return $res;
    }

    /**
     * Checks if domain is available or not.
     *
     * @return boolean
     */
    public function isAvailable()
    {
        if ( checkdnsrr($this->domain . '.', 'ANY') ) {
            return false;
        }

        return true;
    }
}
