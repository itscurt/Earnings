<?php

class Demo extends Earnings{
	/*
		This object creates earning statistics for use for
		demonstration purposes. No arguments are required.
	*/
	function __construct($a = NULL, $b = NULL){
		$this->setNetworkName("Demo Network Statistics");
		$this->setleads(rand(0,5),rand(0,5),rand(10,100));
		$this->setEarnings(rand(250,1000)/100,rand(250,1000)/100,rand(5000,50000)/100);
		$this->setRefEarnings(rand(250,1000)/100,rand(250,1000)/100,rand(5000,50000)/100);
	}
}

?>