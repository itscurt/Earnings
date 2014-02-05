<?php

class TotalEarnings extends Earnings{
	/*
		Accumulates statistics from array of Earnings Objects.
		Usage Example:
			$total = new TotalEarnings(array($obj1, $obj2));
			$total->printEarnings();

	*/
	function __construct($arr = NULL){
		$this->setNetworkName("Total Earnings");
		foreach($arr as $obj){
			$this->setLeadsToday($this->getLeadsToday() + $obj->getLeadsToday());
			$this->setLeadsYesterday($this->getLeadsYesterday() + $obj->getLeadsYesterday());
			$this->setLeadsMonth($this->getLeadsMonth() + $obj->getLeadsMonth());
			$this->setEarningsToday($this->getEarningsToday() + $obj->getEarningsToday());
			$this->setEarningsYesterday($this->getEarningsYesterday() + $obj->getEarningsYesterday());
			$this->setEarningsMonth($this->getEarningsMonth() + $obj->getEarningsMonth());
			$this->setRefEarningsToday($this->getRefEarningsToday() + $obj->getRefEarningsToday());
			$this->setRefEarningsYesterday($this->getRefEarningsYesterday() + $obj->getRefEarningsYesterday());
			$this->setRefEarningsMonth($this->getRefEarningsMonth() + $obj->getRefEarningsMonth());
		}
	}
}

?>