<?php

class CPAgrip extends Earnings{
	/*
		Fetches earnings from CPAgrip.com.
		Requires publisher email address and base64 encoded password.

		Sign up for Adnooka via: http://bit.ly/CPAgripSignup
	*/
	function __construct($email = NULL, $base64pw = NULL){
		$this->setNetworkName("CPAgrip Statistics");
		$ch = curl_init();
		$cookie_file_path="/tmp/cpagrip";
		curl_setopt($ch, CURLOPT_URL, "https://www.cpagrip.com/admin/index.php");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "login=true&email=" . urlencode($email) . "&pwd=" . urlencode(base64_decode($base64pw)));
		$data = curl_exec($ch);
		if(strpos($data, "LOGIN FAILED")){
			$this->setError("Invalid publisher email or password.");
		}else{
			$dom = new DOMDocument();
			@$dom->loadHTML(substr($data, strpos($data,"<strong>Today</strong>")));
			$elems = $dom->getElementsByTagName("td");
			$this->setEarnings(
				$elems->item(3)->nodeValue,
				$elems->item(10)->nodeValue,
				$elems->item(17)->nodeValue
			);

			$this->setleads(
				$elems->item(2)->nodeValue,
				$elems->item(9)->nodeValue,
				$elems->item(16)->nodeValue
			);
		}
		curl_close($ch);
	}
}

?>