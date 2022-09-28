<?php
require 'db_conn.php';

if(isset($_POST["submit"])){
    $name = $_POST['name'];
    $latitude =$_POST['latitude'];
    $longitude =$_POST['longitude'];

    $query="INSERT INTO locations VALUES('$name','$latitude','$longitude')";
    mysqli_query($conn,$query);

    echo "<script> document.location.href = 'data.php'; </script>";
}
?>

<!DOCTYPE html>
<html lang="en" dir="itr">
    <head>
        <meta charset="utf-8">
        <title>Insert Data  with geological data</title>
    </head>
<body onload = "getLocation();">
<div>
<form class="myForm" action="" method="post" autocomplete="off">
    <label for="">Name</label>
    <input type="text" name="name" required value=""> <br>
    <input type="hidden" name="latitude" value="">
    <input type="hidden" name="longitude" value="">
    <button type="submit" name="submit" >Submit your location</button>
</form>
</div>

<script type="text/javascript">
    function getLocation(){
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(showPosition);

        }
    }
    function showPosition(position){

        document.querySelector('.myForm input[name="latitude"]').value=position.coords.latitude;
        document.querySelector('.myForm input[name="longitude"]').value=position.coords.longitude;

    }
    
    function showError(error){
        switch (error.code) {
            case error.PERMISSION_DENIED:
                alert("You must allow the request for geolocation to fill the form ");
                location.reload();
                break;
        
            default:
                break;
        }
    }
</script>
<br>
<a href="data.php">Database Page</a>
</body>
</html>
