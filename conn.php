<?php
    $conn = mysqli_connect("localhost","root","","billing");

    if($conn)
    {
        echo "Connection Successfully";
    }else{
        echo "Connection Failed";
    }

?>