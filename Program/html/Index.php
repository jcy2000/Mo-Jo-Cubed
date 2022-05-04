<?php 
	require_once '../php/config/controller.php'; 
	require_once '../php/controller/TACon.php';
	$db = new DBcontrol();
	$conn = $db->connect();
	$dCtrl  =	new TableALLController($conn);
	$games = $dCtrl->index();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Datatable Implementation in PHP</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
	
	<link rel="stylesheet" href="css/css.css">

</head>
<body>
<div id="application">
            <div class="topnav">
                    <a href="home.html">Home</a>
                    <a class="active" href="Tables">Main Table</a>
                    <a href="Visual.php">Visualization</a>
                    <a href="about.html">About us</a>
                    <a href="contact.html">Contact us</a>
                    <a href="support.html">Support us</a>
                    <a href="https://github.com/jcy2000/Mo-Jo-Cubed" target="_blank">Our GitHub</a> <br>
            </div>
            <div class="search">
                <input type="text" placeholder="Search..">
                <button type="submit">Submit</button>
            </div>

            <!--Possible Search Options
            Popularity
            Alphabetical Game Search (A-J or something)
            Number of Reviews
            Number of Reviews Made
            Number of Owned Games
            Language
            Early Access
            Number of Comments
            -->
            <div class="sidenav">
                <a href="Index.php">Main Review Table</a>
                <a href="IndexTableMG.php">Game Search</a>
				<a href="IndexTableEAR.php">Reviews Made Durring Early Access</a>
				<a href="#">Popular</a>
            </div>
            
            
            <div class="main">
			<div class="container mt-5">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-12 m-auto">
				<table class="table table-bordered table-hovered table-striped" id="gamesTable">
					<thead>
                        <th> review_id </th>
						<th> appid </th>
						<th> authorsteamid </th>
						<th> playtimetotal </th>
                        <th> comentcount </th>
						<th> recommended </th>
						<th> earlyaccess </th>
						<th> playtimeatreview </th>
					</thead>

					<tbody>

					<?php 
						foreach($games as $games) : ?>

							<tr>
								<td> <?php echo $games['review_id']; ?> </td>
								<td> <?php echo $games['appid']; ?> </td>
								<td> <?php echo $games['authorsteamid']; ?> </td>
								<td> <?php echo $games['playtimetotal']; ?> </td>
                                <td> <?php echo $games['comentcount']; ?> </td>
								<td> <?php echo $games['recommended']; ?> </td>
								<td> <?php echo $games['earlyaccess']; ?> </td>
								<td> <?php echo $games['playtimeatreview']; ?> </td>
							</tr>


						<?php endforeach; ?>	


					</tbody>	
				</table>
			</div>
		</div>

            </div>
        </div>
	
	</div>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

	
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

</body>
</html>


<script>
	$(document).ready(function() {
    	$('#gamesTable').DataTable();
	});


</script>