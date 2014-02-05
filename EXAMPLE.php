<?php

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
$network1->printEarnings();
$network2->printEarnings();
$network3->printEarnings();
$totals->printEarnings();


?>
</body>

</html>