<?
class Earnings{
	private $network_name = "";
	private $earnings_today = 0.00;
	private $earnings_yesterday = 0.00;
	private $earnings_month = 0.00;
	private $earnings_ref_today = 0.00;
	private $earnings_ref_yesterday = 0.00;
	private $earnings_ref_month = 0.00;
	private $leads_today =  0;
	private $leads_yesterday =  0;
	private $leads_month = 0;
	private $table_class = "earnings";
	private $error = NULL;

	public function getNetworkName(){
		return $this->network_name;
	}

	public function getError(){
		return $this->error;
	}

	public function getTableClass(){
		return $this->table_class;
	}

	public function getEarningsToday(){
		return number_format($this->earnings_today,2);
	}

	public function getEarningsYesterday(){
		return number_format($this->earnings_yesterday,2);
	}

	public function getEarningsMonth(){
		return number_format($this->earnings_month,2);
	}

	public function getRefEarningsToday(){
		return number_format($this->earnings_ref_today,2);
	}

	public function getRefEarningsYesterday(){
		return number_format($this->earnings_ref_yesterday,2);
	}

	public function getRefEarningsMonth(){
		return number_format($this->earnings_ref_month,2);
	}

	public function getLeadsToday(){
		return $this->leads_today;
	}

	public function getLeadsYesterday(){
		return $this->leads_yesterday;
	}

	public function getLeadsMonth(){
		return $this->leads_month;
	}

	public function setNetworkName($a){
		$this->network_name = $a;
	}

	public function setError($a){
		$this->error = $a ;
	}

	public function setTableClass($a){
		$this->table_class = $a;
	}

	public function setEarnings($a = 0, $b = 0, $c = 0){
		$this->setEarningsToday($a);
		$this->setEarningsYesterday($b);
		$this->setEarningsMonth($c);
	}

	public function setEarningsToday($a){
		$a = str_replace(array(',','$'),'',$a);
		$this->earnings_today = $a;
	}

	public function setEarningsYesterday($a){
		$a = str_replace(array(',','$'),'',$a);
		$this->earnings_yesterday = $a;
	}

	public function setEarningsMonth($a){
		$a = str_replace(array(',','$'),'',$a);
		$this->earnings_month = $a;
	}

	public function setRefEarnings($a = 0,$b = 0,$c = 0){
		$this->setRefEarningsToday($a);
		$this->setRefEarningsYesterday($b);
		$this->setRefEarningsMonth($c);
	}

	public function setRefEarningsToday($a){
		$a = str_replace(array(',','$'),'',$a);
		$this->earnings_ref_today = $a;
	}

	public function setRefEarningsYesterday($a){
		$a = str_replace(array(',','$'),'',$a);
		$this->earnings_ref_yesterday = $a;
	}

	public function setRefEarningsMonth($a){
		$a = str_replace(array(',','$'),'',$a);
		$this->earnings_ref_month = $a;
	}

	public function setLeads($a = 0, $b = 0, $c = 0){
		$this->setLeadsToday($a);
		$this->setLeadsYesterday($b);
		$this->setLeadsMonth($c);
	}

	public function setLeadsToday($a){
		$a = str_replace(',','',$a);
		$this->leads_today = $a;
	}

	public function setLeadsYesterday($a){
		$a = str_replace(',','',$a);
		$this->leads_yesterday = $a;
	}

	public function setLeadsMonth($a){
		$a = str_replace(',','',$a);
		$this->leads_month = $a;
	}

	public function earningsHTML(){
		$html = "
				<table class =\"" . $this->getTableClass() . "\">
					<caption>" . $this->getNetworkName() . "</caption>
					<thead>
						<tr>
							<th>&nbsp;</th><th>Today</th><th>Yesterday</th><th>MTD</th>

						</tr>
					</thead>
					<tbody>
				";
		if($this->getError()){
			$html .= "<tr><th>Error</th><td colspan=\"3\">" . $this->getError() . "</td></tr>";
		}else{
			if($this->getLeadsMonth() + $this->getLeadsToday() + $this->getLeadsYesterday() > 0)
				$html .= "	<tr>
								<th>Leads</th>
								<td>".number_format($this->getLeadsToday())."</td>
								<td>".number_format($this->getLeadsYesterday())."</td>
								<td>".number_format($this->getLeadsMonth())."</td>
							<tr>
							<tr>
								<th>EPL</th>
								<td>$".@number_format($this->getEarningsToday() / $this->getLeadsToday(),2)."</td>
								<td>$".@number_format($this->getEarningsYesterday() / $this->getLeadsYesterday(),2)."</td>
								<td>$".@number_format($this->getEarningsMonth() / $this->getLeadsMonth(),2)."</td>
							<tr>

			";
			$html .= "		<tr>
								<th>Earnings</th>
								<td>$".number_format($this->getEarningsToday(),2)."</td>
								<td>$".number_format($this->getEarningsYesterday(),2)."</td>
								<td>$".number_format($this->getEarningsMonth(),2)."</td>
							<tr>
			";
			if($this->getRefEarningsMonth() > 0)
				$html .= "<tr>
								<th>Ref Earnings</th>
								<td>$".number_format($this->getRefEarningsToday(),2)."</td>
								<td>$".number_format($this->getRefEarningsYesterday(),2)."</td>
								<td>$".number_format($this->getRefEarningsMonth(),2)."</td>
							<tr>
							<tr>
								<th>Total</th>
								<td>$".number_format($this->getRefEarningsToday() + $this->getEarningsToday(),2)."</td>
								<td>$".number_format($this->getRefEarningsYesterday() + $this->getEarningsYesterday(),2)."</td>
								<td>$".number_format($this->getRefEarningsMonth() + $this->getEarningsMonth(),2)."</td>
							<tr>
			";
		}
		$html .= "</tbody></table>";
		return $html;
	}

	public function printEarnings(){
		print($this->earningsHTML());
	}
}
?>