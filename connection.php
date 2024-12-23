<?php 
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $con = mysqli_connect('localhost','	trust96m_test','trust96m_admin','Test@db24');
    if(!$con)
    {
        echo 'please check your Database connection';
    }






?>