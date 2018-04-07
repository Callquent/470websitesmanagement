<?php
/**
 * @package GoogleScraper
 * @author Callquent
 * @version : 1.0
 */
class Googlescraper
{
	private $keyword				=	"";
	private $number_page			=	"";
	private $metaList				=	"";
	private $cookie					=	"";
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
	function fetchUrlList()
	{
		$data=$this->getpagedata('https://www.google.com/search?q='.$this->keyword.'&num='.$this->number_page);
		preg_match('/;ei=(.*?)&amp;/siU', $data, $matches);
		$this->ei=urlencode($matches[1]);
		if ($data) {
			if(preg_match("/sorry.google.com/", $data)) {
				echo "You are blocked";
				exit;
			} else {
				preg_match_all('/<div\sclass="rc">.*<span.*class="st">.*<\/span>.*<\/div>/siU', $data, $meta_google_search);

				for ($j = 0; $j <= count($meta_google_search[0])-1; $j++) {

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

	function answer() {
		"Hello,".$user." what do you want ?"
		"Voulez l'envoyer".$mail
	}
	function ask($questions) {
		"Sorry, I don't understand"
		"go to ".$website
		"ftp ".$website
		"database ".$website
		"backoffice ".$website
		"htpassword ".$website
		"IP ".$website
		"whois ".$website
		"expiration ".$website
		"count all"
	}
}	
?>