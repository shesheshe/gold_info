<?php
$data = get_info();

echo json_encode($data);

function get_info() {
    $url = "http://www.esunbank.com.tw/info/goldpassbook.aspx"; //您想抓取的網址
	
	$page_content = file_get_contents($url);
	$page_content = str_replace(array("\r\n","\n"), array("",""), $page_content);

	if(preg_match_all('/<tr class="tableContent-light">(.*)<\/tr>/U', $page_content, $matches)) {

		if(preg_match_all('/<td class="default-color7" align="center">(.*)<\/td>/U', $matches[1][1], $matches2)) {

		} else {
			return "掛了 Orz...";
		}
	} else {
		return "掛了 Orz...";
	}
	return $matches2[1];
}