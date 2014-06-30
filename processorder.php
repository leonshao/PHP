<?php
	// create short variable names
	$tireqty		= $_POST['tireqty'];
	$oilqty			= $_POST['oilqty'];
	$sparkqty		= $_POST['sparkqty'];
	$address		= $_POST['address'];
	$DOCUMENT_ROOT	= $_SERVER['DOCUMENT_ROOT'];
	$date			= date("H:i, jS F Y");
?>
<html>
<head>
<meta charset="UTF-8">
<title>Bob's Auto Parts - Order Results</title>
</head>

<body>
<h1>Bob's Quto Parts</h1>
<h2>Order Results</h2>
<?php
	echo "<p>Order Processed at".$date."</p>";
	echo "<p>Your order is as follows:</p>";
	
	$totalqty = $tireqty + $oilqty + $sparkqty;
	if ($totalqty == 0) {
		echo "You did not order anything on the previos page!<br/>";
		exit;
	}
	else {
		if ($tireqty > 0) {
			echo $tireqty." tires<br/>";
		}
		if ($oilqty > 0) {
			echo $oilqty." bottles of oil<br/>";
		}
		if ($sparkqty > 0) {
			echo $sparkqty." spark plugs<br/>";
		}
	}
	
	echo "Items ordered: ".$totalqty."<br/>";
	
	define('TIREPRICE', 100);
	define('OILPRICE', 10);
	define('SPARKPRICE', 4);
	
	$totalamount = $tireqty * TIREPRICE
				 + $oilqty * OILPRICE
				 + $sparkqty * SPARKPRICE;
	echo "Subtotal: $".number_format($totalamount, 2, '.', ' ')."<br/>";
	
	$taxrate = 0.10;
	$totalamount = $totalamount * (1 + $taxrate);
	echo "Total including tax: $".number_format($totalamount, 2)."<br/>";
	
	echo "Address to ship is ".$address."<br/>";

	$outputstring = $date."\t".$tireqty." tires\t".$oilqty." oil\t"
					.$sparkqty." spark plugs\t\$".$totalamount
					."\t".$address."\n";
	
	// open file with append mode
	$fp = fopen("$DOCUMENT_ROOT/orders.txt", 'ab');
	if (!$fp) {
		echo "<p><strong> Your order could not be processed at this time.
			  Please try again later.</strong></p></body></html>";
		exit;
	}

	flock($fp, LOCK_EX);
	fwrite($fp, $outputstring, strlen($outputstring));
	flock($fp, LOCK_UN);
	fclose($fp);
	
	echo "<p>Order written.</p>";
?>

</body>
</html>