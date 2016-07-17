<?php
/**
 * @package GoogleScraper
 * @author Callquent
 * @version : 1.0
 */
class Googlescraper
{
	private $keyword				=	"";
	private $metaurlList			=	"";
	private $cookie					=	"";
	private $header					=	"";
	private $ei						=	"";

	
	function __construct() {
		$this->cookie = tempnam ("/tmp", "cookie");
		$this->headers[] = "Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5"; 
		$this->headers[] = "Connection: keep-alive"; 
		$this->headers[] = "Keep-Alive: 115"; 
		$this->headers[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7"; 
		$this->headers[] = "Accept-Language: en-us,en;q=0.5"; 
		$this->headers[] = "Pragma: "; 
	}

	function getpagedata($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
       	curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:34.0) Gecko/20100101 Firefox/34.0"); 
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 3);

		$data=curl_exec($ch);
		curl_close($ch);
		return $data;
	}

	function initGoogle() {
		$data=$this->getpagedata('https://www.google.com');
		sleep(2);
		$this->getpagedata('https://www.google.com/ncr');
	}

	function fetchUrlList()
	{
		$data=$this->getpagedata('https://www.google.com/search?q='.urlencode($this->keyword).'&num=100');
		preg_match('/;ei=(.*?)&amp;/siU', $data, $matches);
		$this->ei=urlencode($matches[1]);
		if ($data) {
			if(preg_match("/sorry.google.com/", $data)) {
				echo "You are blocked";
				exit;
			} else {
				preg_match_all('/<div\s*class="g">.*<h3\s*class="r"><a\s[^>]*href\s*=\s*\"([^\"]*)\"[^>]*>.*<\/a><\/h3>.*<\/div>/siU', $data, $meta_url);
				for ($j = 0; $j <= 100; $j++) {
					if (isset($meta_url[1][$j]) && !is_null($meta_url[1][$j])) {
						$this->metaurlList[] =  html_entity_decode($meta_url[1][$j],ENT_QUOTES);
					}
				}
			}
		} 
		else 
		{
			echo "Problem fetching the data";
			exit;
		}
	}

	function getUrlList($keyword,$proxy='') {
		$this->keyword=$keyword;
		$this->initGoogle();
		sleep(2);
		$this->fetchUrlList();
		sleep(2);
		return $this->metaurlList;
	}
}	
?>