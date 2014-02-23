<?

class Adnooka extends Earnings{
	/*
		Fetches earnings from Adnooka.com.
		Requires publisher email address and base64 encoded password.

		Sign up for Adnooka via: http://bit.ly/adnooka
	*/
	function __construct($email = NULL, $base64pw = NULL){
		$this->setNetworkName("Adnooka Statistics");
		$ch = curl_init();
		$cookie_file_path="/tmp/adnooka";
		curl_setopt($ch, CURLOPT_URL, "http://adnooka.com/login");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "email=" . urlencode($email) . "&password=" . urlencode(base64_decode($base64pw)));
		$adnookdata = curl_exec($ch);
		if(strpos(curl_getinfo($ch, CURLINFO_EFFECTIVE_URL), "/login")){
			$this->setError("Invalid publisher email or password.");
		}else{
			$dom = new DOMDocument();
			@$dom->loadHTML($adnookdata);
			$sidebar = $dom->getElementById("sidebar");
			$elems = $sidebar->getElementsByTagName("span");
			$this->setEarnings(
				$elems->item(0)->nodeValue,
				$elems->item(1)->nodeValue,
				$elems->item(2)->nodeValue
			);
			$this->setRefEarnings(
				$elems->item(5)->nodeValue,
				$elems->item(6)->nodeValue,
				$elems->item(7)->nodeValue
			);
		}
		curl_close($ch);
	}
}

?>