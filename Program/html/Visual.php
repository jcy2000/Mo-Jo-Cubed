<?php

 $db = mysqli_connect('washington.uww.edu','grinkazr27','zg8216','cs366-2221_grinkazr27')
 or die('Error connecting to MySQL server.');

?>

<html>
 <head>
 <title>Home Page</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/css.css">
 </head>
 <body>
 <body>
        <div id="application">
            <div class="topnav">
                    <a href="home.html">Home</a>
                    <a href="table.html">Main Table</a>
                    <a class="active" href="visual.php">Visualization</a>
                    <a href="about.html">About us</a>
                    <a href="contact.html">Contact us</a>
                    <a href="support.html">Support us</a>
                    <a href="https://github.com/jcy2000/Mo-Jo-Cubed" target="_blank">Our GitHub</a> <br>
            </div>
            <div class="search">
                <input type="text" placeholder="Search..">
                <button type="submit">Submit</button>
            </div>

 <div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<?php
   

$query = "SELECT COUNT(*) FROM SteamOwns WHERE gameattainment = 'Other'";
mysqli_query($db, $query) or die('Error querying database.');


$result = mysqli_query($db, $query);

$result = $result->fetch_array();
$quantityOther = intval($result[0]);



$query = "SELECT COUNT(*) FROM SteamOwns WHERE gameattainment = 'Purchased'";
mysqli_query($db, $query) or die('Error querying database.');


$result = mysqli_query($db, $query);

$result = $result->fetch_array();
$quantityPaid = intval($result[0]);



$query = "SELECT COUNT(*) FROM SteamOwns WHERE gameattainment = 'Received For Free'";
mysqli_query($db, $query) or die('Error querying database.');


$result = mysqli_query($db, $query);

$result = $result->fetch_array();
$quantityFree = intval($result[0]);

$query = "SELECT COUNT(*) FROM SteamOwns WHERE gameattainment = 'Other'";
mysqli_query($db, $query) or die('Error querying database.');
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