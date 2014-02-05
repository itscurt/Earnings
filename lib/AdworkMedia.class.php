<?php

class AdworkMedia extends Earnings {
	/*
		Fetches referral and lead earnings from AdworkMedia.com.
		Receive Publisher ID and API Key via: http://bit.ly/adworkmediaapisettings

		Sign up for AdworkMedia via: http://bit.ly/AdworkMediaRegister
	*/
	function __construct($pubid = NULL, $apikey = NULL){
		$this->setNetworkName("Adwork Media Statistics");
		$today = date("Y-m-d");
		$yesterday = date("Y-m-d", time() - 24*60*60);
		$tomorrow = date("Y-m-d", time() + 24*60*60);
		$month = date("Y-m-01");
		$apilink = "https://www.adworkmedia.com/api/stats.php?pubID={$pubid}&apiID={$apikey}";
		if(strpos("Invalid", file_get_contents($apilink))){
			$this->setError("Invalid publisher ID or API Key.");
			return;
		}
		$awmyesterday = $apilink . "&start_date={$yesterday}&end_date={$yesterday}";
		$awmtoday = $apilink . "&start_date={$today}&end_date={$today}";
		$awmmonth = $apilink . "&start_date={$month}&end_date={$today}";

		//day stats
		$awmtoday = @simplexml_load_file($awmtoday);
		$awmyesterday = @simplexml_load_file($awmyesterday);
		$awmmonth = @simplexml_load_file($awmmonth);

		if(!$awmtoday){
			$this->setError("Error fetching from API URL.");
			return;
		}

		$this->setLeads($awmtoday->data->leads,$awmyesterday->data->leads,$awmmonth->data->leads);
		$this->setEarnings($awmtoday->data->lead_earnings, $awmyesterday->data->lead_earnings, $awmmonth->data->lead_earnings);
		$this->setRefEarnings($awmtoday->data->referral_earnings, $awmyesterday->data->referral_earnings, $awmmonth->data->referral_earnings);
	}
}

?>