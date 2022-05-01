<?php

 $db = mysqli_connect('washington.uww.edu','grinkazr27','zg8216','cs366-2221_grinkazr27')
 or die('Error connecting to MySQL server.');

?>

<html>
 <head>
 </head>
 <body>
 <h1>PHP connecting to MySQL</h1>

 <div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<?php
   

$query = "SELECT COUNT(*) FROM SteamOwns WHERE gameattainment = 'Other'";
mysqli_query($db, $query) or die('Error querying database.');


$result = mysqli_query($db, $query);

$result = $result->fetch_array();
$quantityOther = intval($result[0]);

echo $quantityOther;

$query = "SELECT COUNT(*) FROM SteamOwns WHERE gameattainment = 'Purchased'";
mysqli_query($db, $query) or die('Error querying database.');


$result = mysqli_query($db, $query);

$result = $result->fetch_array();
$quantityPaid = intval($result[0]);

echo "<br>";
echo $quantityPaid;

$query = "SELECT COUNT(*) FROM SteamOwns WHERE gameattainment = 'Received For Free'";
mysqli_query($db, $query) or die('Error querying database.');


$result = mysqli_query($db, $query);

$result = $result->fetch_array();
$quantityFree = intval($result[0]);

echo "<br>";
echo $quantityFree;

// while ($row = mysqli_fetch_array($result)) {
//  echo $row['appid'] . ' ' . $row['appname'] .'<br />';
// }

//Step 4
mysqli_close($db);



?>

<Script>
window.onload = function() {
var $other = <?=$quantityOther?>;
var $paid = <?=$quantityPaid?>;
var $free = <?=$quantityFree?>;

var dataForTable = [
    {x: "Paid in Other Way", value: $other},
    {x: "Was Free", value: $free},
    {x: "Paid in House", value: $paid}
];

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "How Steam Games Where Attainted in 2021" 
	},
	data: [{
		type: "pie",
		startAngle: 240,
		yValueFormatString: "",
		indexLabel: "{label} {y}",
		dataPoints: [
			{y: $other, label: "Paid in Other Way"},
			{y: $paid, label: "Paid in House"},
			{y: $free, label: "Was Free"},
		]
	}]
});




    




console.log($other);

};


</Script>
</body>
</html>