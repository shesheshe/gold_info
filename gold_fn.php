<?php
$data[] = get_esunbank();
$data[] = get_taiwanbank();
$data[] = get_huananbank();

echo json_encode($data);

/**
* 取得網頁資料
*/
function get_html($url) {
	$page_content = file_get_contents($url);
	return str_replace(array("\r\n","\n"), array("",""), $page_content);
}

/**
* 移除,
*/
function money2number($money) {
	return str_replace(",", "", $money);
}

/**
* 取得價差
*/
function get_spread($sell, $buy) {
	return money2number($sell) - money2number($buy);
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
	return array(0=>"玉山銀行", 
	             1=>$matches2[1][2], 
				 2=>$matches2[1][1], 
				 3=>get_spread($matches2[1][2], $matches2[1][1]));
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
	return array(0=>"台灣銀行", 
	             1=>number_format($matches2[1][6]), 
				 2=>number_format($matches2[1][13]), 
				 3=>get_spread($matches2[1][6], $matches2[1][13]));
}

function get_huananbank() {
	$page_content = get_html("http://ibank.hncb.com.tw/netbank/pages/jsp/IportalApplet/GoldBankBookHtml.html");

	if(preg_match_all('/<td(.*)>(.*)<\/td>/U', $page_content, $matches)) {

	} else {
		return array(0=>"掛了 Orz...");
	}
	
	$sell = substr($matches[2][5], 0, -5);
	$buy = substr($matches[2][4], 0, -5);
	
	return array(0=>"華南銀行", 
	             1=>number_format($sell), 
				 2=>number_format($buy), 
				 3=>get_spread($sell, $buy));
}