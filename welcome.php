<?php 

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: multi.php");
	
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
	<style>
		table,tr,th,td
		{
			border: 2px solid black;
			border-collapse: collapse;
		}
		th
		{
			background-color: #00e1ff;
			font-family: sans-serif;
			text-align: center;
		}
		tr
		{
			background-color: #d9d6c7;
			font-family: sans-serif;
			text-align: center;
		}
		tr:hover
		{
			background-color: #00ff8c;
			color: brown;
		}
	</style>
</head>

<body>
    <?php echo "<h1>Welcome " . $_SESSION['username'] . "</h1>"; ?>
	<p><br><br></p>
	<table>'
			<tr>
				<th>  Index  </th>
				<th>  Citizen Name  </th>
				<th>  Time of Pickup </th>
				<th>  Garbage Category </th>
				<th>  Garbage Amount in Kg </th>
				<th>  Pickup Location </th>
			</tr>
		<?php
			include 'db_conn.php';
			$pickup = $conn->query("SELECT * FROM pickup,locations");
			$i=1;
			while($row = $pickup->fetch_assoc()):
		?>
			<tr>
				<td> <?php echo $i++ ?> </td>
				<td> <?php echo $row['Full_Name'] ?> </td>
				<td> <?php echo $row['Slot_Time'] ?> </td>
				<td> <?php echo $row['Garbage_Category'] ?> </td>
				<td> <?php echo $row['Amount_Garbage_kg'] ?> </td>
				<td style="width: 450px; height: 450px;"> <iframe src='https://www.google.com/maps?q=<?php echo $row["latitude"]; ?>,<?php echo $row["longitude"];?>&hl=es;z=14&output=embed' style="width:100%; height: 100%;"> </iframe></td>
			</tr>
		<?php endwhile; ?>
	<table>
	<p><br><br></p>
    <a href="logout.php">Logout</a>
	
</body>
</html>