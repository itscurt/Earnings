<?php

class AdscendMedia extends Earnings{
	/*
		Fetches earnings from AdscendMedia.com.
		Requires publisher email address and base64 encoded password.

		Sign up for Adnooka via: http://bit.ly/AdscendMediaSignup
	*/

	function __construct($email = NULL, $base64pw = NULL){
		$this->setNetworkName("Adscend Media Statistics");
		$ch = curl_init();
		$cookie_file_path="/tmp/adscendlogin";
		curl_setopt($ch, CURLOPT_URL, "https://adscendmedia.com/login.php");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "submitted=1&email=" . urlencode($email) . "&password=" . urlencode(base64_decode($base64pw)) . "&imageField.x=1&imageField.y=-1");
		$adscenddata = curl_exec($ch);
		if(strpos(curl_getinfo($ch, CURLINFO_EFFECTIVE_URL), "login.php")){
			$this->setError("Invalid publisher email or password.");
		}else{
			@preg_match_all("#([0-9]*) leads, (.*)</td>#", $adscenddata,$res);
			$this->setLeads($res[1][0],$res[1][1],$res[1][2]);
			$this->setEarnings($res[2][0],$res[2][1],$res[2][2]);
		}
		curl_close($ch);
	}
}

?>