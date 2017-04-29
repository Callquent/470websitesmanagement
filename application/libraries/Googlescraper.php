<?php
/**
 * @package GoogleScraper
 * @author Callquent
 * @version : 1.0
 */
class Googlescraper
{
	private $keyword				=	"testing";
	private $metaList				=	"";
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
		$this->getpagedata('https://www.google.com/ncr');
	}

	function fetchUrlList($number_page)
	{
		$data=$this->getpagedata('https://www.google.com/search?q='.$this->keyword.'&num='.$number_page);
		preg_match('/;ei=(.*?)&amp;/siU', $data, $matches);
		$this->ei=urlencode($matches[1]);
		if ($data) {
			if(preg_match("/sorry.google.com/", $data)) {
				echo "You are blocked";
				exit;
			} else {
				preg_match_all('/<div\sclass="rc">.*<span.*class="st">.*<\/span>.*<\/div>/siU', $data, $meta_google_search);

				for ($j = 0; $j < $number_page-1; $j++) {

					preg_match_all('/<cite.*>([^\"]*)<\/cite>/siU', $meta_google_search[0][$j], $meta_cite);
					preg_match_all('/<h3\s*class="r".*><a\s[^>]*href=\"(.*)\".*>.*<\/a><\/h3>/siU', $meta_google_search[0][$j], $meta_url);
					preg_match_all('/<h3\s*class="r".*><a\s[^>]*href\s*=\s*\"[^>]*>(.*)<\/a><\/h3>/siU', $meta_google_search[0][$j], $meta_title);
					preg_match_all('/<span\s*class="st">(<span\s*class="f">.*<\/span>(.*)<\/span>|(.*)<\/span>)/siU', $meta_google_search[0][$j], $meta_description);

					if ($meta_title[1][0] && $meta_url[1][0] && $meta_description[1][0]) {
						if (isset($meta_url[1][0]) && !is_null($meta_url[1][0])) {
							$this->metaList[$j]['url'] =  html_entity_decode($meta_url[1][0],ENT_QUOTES);
						}
						if (isset($meta_title[1][0]) && !is_null($meta_title[1][0])) {
							$this->metaList[$j]['title'] =  html_entity_decode($meta_title[1][0],ENT_QUOTES);
						}
						if ($meta_description) {
							if (!empty($meta_description[2][0]) ) {
								$this->metaList[$j]['description'] = ($meta_description[2][0]);
							} else if (!empty($meta_description[3][0]) ) {
								$this->metaList[$j]['description'] = ($meta_description[3][0]);
							}
						}
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

	function getUrlList($keyword,$number_page,$proxy='') {
		$this->keyword=$keyword;
		$this->initGoogle();
		$this->fetchUrlList($number_page);
		sleep(2);
		return $this->metaList;
	}
}	
?>