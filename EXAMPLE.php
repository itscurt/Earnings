<?php

function earningsHTML($earnings_object){
	$html = "
			<table class =\"" . $earnings_object->getTableClass() . "\">
				<caption>{$earnings_object->getNetworkName()}</caption>
				<thead>
					<tr>
						<th>&nbsp;</th><th>Today</th><th>Yesterday</th><th>MTD</th>

					</tr>
				</thead>
				<tbody>
			";
	if($earnings_object->getError()){
		$html .= "<tr><th>Error</th><td colspan=\"3\">{$earnings_object->getError()}</td></tr>";
	}else{
		if($earnings_object->getLeadsMonth() + $earnings_object->getLeadsToday() + $earnings_object->getLeadsYesterday > 0)
			$html .= "	<tr>
							<th>Leads</th>
							<td>".number_format($earnings_object->getLeadsToday())."</td>
							<td>".number_format($earnings_object->getLeadsYesterday())."</td>
							<td>".number_format($earnings_object->getLeadsMonth())."</td>
						<tr>
						<tr>
							<th>EPL</th>
							<td>$".@number_format($earnings_object->getEarningsToday() / $earnings_object->getLeadsToday(),2)."</td>
							<td>$".@number_format($earnings_object->getEarningsYesterday() / $earnings_object->getLeadsYesterday(),2)."</td>
							<td>$".@number_format($earnings_object->getEarningsMonth() / $earnings_object->getLeadsMonth(),2)."</td>
						<tr>

		";
		$html .= "		<tr>
							<th>Earnings</th>
							<td>$".number_format($earnings_object->getEarningsToday(),2)."</td>
							<td>$".number_format($earnings_object->getEarningsYesterday(),2)."</td>
							<td>$".number_format($earnings_object->getEarningsMonth(),2)."</td>
						<tr>
		";
		if($earnings_object->getRefEarningsMonth() > 0)
			$html .= "<tr>
							<th>Ref Earnings</th>
							<td>$".number_format($earnings_object->getRefEarningsToday(),2)."</td>
							<td>$".number_format($earnings_object->getRefEarningsYesterday(),2)."</td>
							<td>$".number_format($earnings_object->getRefEarningsMonth(),2)."</td>
						<tr>
						<tr>
							<th>Total</th>
							<td>$".number_format($earnings_object->getRefEarningsToday() + $earnings_object->getEarningsToday(),2)."</td>
							<td>$".number_format($earnings_object->getRefEarningsYesterday() + $earnings_object->getEarningsYesterday(),2)."</td>
							<td>$".number_format($earnings_object->getRefEarningsMonth() + $earnings_object->getEarningsMonth(),2)."</td>
						<tr>
		";
	}
	$html .= "</tbody></table>";
	return $html;
}
	
require_once("./lib/Earnings.class.php");

function __autoload($class_name){
	if(!file_exists("./lib/". $class_name . ".class.php"))
		return false;
	include("./lib/". $class_name . ".class.php");
}

$network1 = new Demo("user","pass");
$network2 = new Demo("user","pass");
$network3 = new Demo("user","pass");
$totals = new TotalEarnings(array($network1,$network2,$network3));

?>
<html>
<head>
	<link href="./css/tables.css" type="text/css" rel="stylesheet">
	<title>Today's Earnings!</title>
</head>

<body>
<?php

echo "<h1>I've made a total of $" . ($totals->getEarningsMonth() + $totals->getRefEarningsMonth()) . "  this month.</h1>";
echo earningsHTML($network1);
echo earningsHTML($network2);
echo earningsHTML($network3);
echo earningsHTML($totals);


?>
</body>

</html>