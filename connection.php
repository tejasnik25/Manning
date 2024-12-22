<?php 
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $con = mysqli_connect('localhost','	kamilmwg_myuser','Test@db24','kamilmwg_tutorial');
    if(!$con)
    {
        echo 'please check your Database connection';
    }







?>