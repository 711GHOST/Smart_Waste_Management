<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['Full_Name']) || isset($_POST['Slot_Time']) ||
        isset($_POST['Garbage_Category']) || isset($_POST['Amount_Garbage_kg'])) {
        $Full_Name = $_POST['Full_Name'];
        $Slot_Time = $_POST['Slot_Time'];
        $Garbage_Category = $_POST['Garbage_Category'];
        $Amount_Garbage = $_POST['Amount_Garbage_kg'];
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "pickup_request";
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT Full_Name FROM pickup WHERE Full_Name = ? LIMIT 1";
            $Insert = "INSERT INTO pickup(Full_Name, Slot_Time, Garbage_Category, Amount_Garbage_kg) values(?, ?, ?, ?)";
            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $Full_Name);
            $stmt->execute();
            $stmt->bind_result($Full_Name);
            $stmt->store_result();
            $rnum = $stmt->num_rows;
            if ($rnum == 0) {
                $stmt->close();
                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("sssi",$Full_Name, $Slot_Time, $Garbage_Category, $Amount_Garbage);
                $stmt->execute();
                echo "Booking Done Sucessfully in our Database. We will soon contact you.";
            }
            else {
                echo "Already in Progress or time is less than 24 hours";
            }
            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "All field are required.";
        die();
    }
}
else {
    echo "Submit button is not set";
}
?>