<?php

class CPAlead extends Earnings{
	/*
		Fetches referral and lead earnings from CPAlead.com.
		Receive statskey from: http://bit.ly/CPAleadStatsKey

		Sign up for CPAlead via: http://bit.ly/CPAleadsignup
	*/

	function __construct($email = NULL, $statskey = NULL){
		$this->setNetworkName("CPAlead Statistics");
		$feed = @file_get_contents("https://www.cpalead.com/feeds/statistics/mobile.php?id={$email}&p={$statskey}");
		if(!$feed){
			$this->setError("Error fetching from API URL.");
			return;
		}
		if(strpos($feed, "Invalid")){
			$this->setError("Invalid publisher email or statskey.");
			return;
		}
		@preg_match_all('#<td>\$?([0-9,.]*)</td>#', $feed, $res);
		$this->setLeads($res[1][3],$res[1][4],$res[1][5]);
		$this->setEarnings($res[1][6],$res[1][7],$res[1][8]);
		$this->setRefEarnings($res[1][9],$res[1][10],$res[1][11]);
	}
}

?>