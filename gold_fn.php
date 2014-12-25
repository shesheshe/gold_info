<?php
$data[] = get_esunbank();
$data[] = get_taiwanbank();

echo json_encode($data);

/**
* 取得網頁資料
*/
function get_html($url) {
	$page_content = file_get_contents($url);
	return str_replace(array("\r\n","\n"), array("",""), $page_content);
}

function get_esunbank() {
    
	$page_content = get_html("http://www.esunbank.com.tw/info/goldpassbook.aspx");

	if(preg_match_all('/<tr class="tableContent-light">(.*)<\/tr>/U', $page_content, $matches)) {

		if(preg_match_all('/<td class="default-color7" align="center">(.*)<\/td>/U', $matches[1][1], $matches2)) {

		} else {
			return array(0=>"掛了 Orz...");
		}
	} else {
			return array(0=>"掛了 Orz...");
	}
	return array(0=>"玉山銀行", 1=>$matches2[1][1], 2=>$matches2[1][2]);
}

function get_taiwanbank() {
	$page_content = get_html("http://rate.bot.com.tw/Pages/Static/UIP005.zh-TW.htm");

	if(preg_match_all('/<div id="GoldBankBookForTWD">(.*)<\/div>/U', $page_content, $matches)) {
		if(preg_match_all('/<td class="decimal">(.*)<\/td>/U', $matches[0][0], $matches2)) {

		} else {
			return array(0=>"掛了 Orz...");
		}

	} else {
		return array(0=>"掛了 Orz...");
	}
	return array(0=>"台灣銀行", 1=>number_format($matches2[1][13]), 2=>number_format($matches2[1][6]));
}


