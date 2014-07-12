<?php
	$DOCUMENT_ROOT	= $_SERVER['DOCUMENT_ROOT'];
?>

<html>
<head>
<meta charset="UTF-8">
<title>Bob's Auto Parts - Customer Orders</title>
</head>

<body>
<h1>Bob's Quto Parts</h1>
<h2>Customer Orders</h2>

<?php
/* 	$fp = fopen("$DOCUMENT_ROOT/orders.txt", "rb");
	if (!$fp) {
		echo "<p><strong>No orders pending.
			  Please try again later.</strong></p></body></html>";
		exit;
	} 
	
	while (!feof($fp)) {
		$order = fgets($fp, 999);
		echo $order."<br/>";
	}
	
	echo "Final position of the file pointer is ".(ftell($fp))."<br/>";
	rewind($fp);
	echo "After rewind, the position is ".(ftell($fp))."<br/>"; */

	// Read entire file to array
	$orders = file("$DOCUMENT_ROOT/orders.txt");
	$number_of_orders = count($orders);
	
// 	$orders = array_reverse($orders);
	
	if($number_of_orders == 0) {
		echo "<p><strong>No orders pending. 
			 Please try again later.</strong></p>";
	} else {
		echo "<table border=\"1\">\n";
		echo "<tr><th bgcolor=\"#CCCCFF\">Order Date</th>
			      <th bgcolor=\"#CCCCFF\">Tires</th>
			      <th bgcolor=\"#CCCCFF\">Oil</th>
			      <th bgcolor=\"#CCCCFF\">Spark Plugs</th>
			      <th bgcolor=\"#CCCCFF\">Total</th>
			      <th bgcolor=\"#CCCCFF\">Address</th>
			  </tr>";
		
		foreach ($orders as $line) {
// 		for ($i = 0; $i < $number_of_orders; ++$i) {
// 			$line = $orders[$i];
			$fields = explode("\t", $line);
			
			$fields[1] = intval($fields[1]);
			$fields[2] = intval($fields[2]);
			$fields[3] = intval($fields[3]);
			
			echo "<tr>
			      	<td>".$fields[0]."</td>
					<td align=\"right\">".$fields[1]."</td>
					<td align=\"right\">".$fields[2]."</td>
					<td align=\"right\">".$fields[3]."</td>
					<td align=\"right\">".$fields[4]."</td>
					<td>".$fields[5]."</td>
			      </tr>";
		}
		
		echo "</table>";
	}
?>
</body>
</html>