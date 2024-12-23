<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KAMI</title>
</head>
<body>
<style>
*{
    margin: 0;
    padding: 0;
}
.hai{
    width: 100%;
    background-position: center;
    background-size: cover;
    height: 109vh;
    animation: infiniteScrollBg 50s linear infinite;
}
.main{
    width: 100%;
    background: linear-gradient(to top, rgba(0,0,0,0)50%, rgba(0,0,0,0)50%);
    height: 109vh;
    animation: infiniteScrollBg 50s linear infinite;
}
.navbar{
    width: 1200px;
    height: 75px;
    margin: auto;
}
.icon{
    width:200px;
    float: left;
    height : 70px;
}
.logo{
    color: #ff7200;
    font-size: 35px;
    font-family: Arial;
    padding-left: 20px;
    float:left;
    padding-top: 10px;
}
.menu{
    width: 400px;
    float: left;
    height: 70px;
}
ul{
    float: left;
    display: flex;
    justify-content: center;
    align-items: center;
}
ul li{
    list-style: none;
    margin-left: 62px;
    margin-top: 27px;
    font-size: 14px;
}
ul li a{
    text-decoration: none;
    color: black;
    font-family: Arial;
    font-weight: bold;
    transition: 0.4s ease-in-out;
}
.content-table{
   border-collapse: collapse;
    font-size: 0.9em;
    min-width: 400px;
    border-radius: 5px 5px 0 0;
    overflow: hidden;
    box-shadow:0 0  20px rgba(0,0,0,0.15);
    margin-left : 350px ;
    margin-top: 25px;
    width: 800px;
    height: 500px;
}
.content-table thead tr{
    background-color: orange;
    color: white;
    text-align: left;
}
.content-table th,
.content-table td{
    padding: 12px 15px;
}
.content-table tbody tr{
    border-bottom: 1px solid #dddddd;
}
.content-table tbody tr:nth-of-type(even){
    background-color: #f3f3f3;
}
.content-table tbody tr:last-of-type{
    border-bottom: 2px solid orange;
}
.content-table thead .active-row{
    font-weight:  bold;
    color: orange;
}
.header{
    margin-top: 70px;
    margin-left: 650px;
}
.nn{
    width:100px;
    border:none;
    height: 40px;
    font-size: 18px;
    border-radius: 10px;
    cursor: pointer;
    color:white;
    transition: 0.4s ease;
}
.nn a{
    text-decoration: none;
    color: black;
    font-weight: bold;
}
.but a{
    text-decoration: none;
    color: black;
}   
</style>

<?php
require_once('connection.php');
session_start();

// Prepare the query with a placeholder for the email
$query = "SELECT * FROM users WHERE EMAIL = ?";

// Prepare the statement
$stmt = mysqli_prepare($con, $query);

// Check if the query preparation was successful
if (!$stmt) {
    die("Query preparation failed: " . mysqli_error($con));
}

// Bind the parameter (assuming the email is passed via GET or session)
$email = $_SESSION['email'];  // Assuming the email is stored in the session after login
mysqli_stmt_bind_param($stmt, "s", $email);  // "s" for string (email is a string)

// Execute the query
mysqli_stmt_execute($stmt);

// Get the result
$result = mysqli_stmt_get_result($stmt);

// Check if any rows were returned
if ($result) {
    echo '<div class="hai">
            <div class="navbar">
                <div class="icon">
                    <h2 class="logo">CaRs</h2>
                </div>
                <div class="menu">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><button class="nn"><a href="index.php">LOGOUT</a></button></li>
                    </ul>
                </div>
            </div>
            <div>
                <div>
                    <table class="content-table">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th> 
                                <th>EMAIL</th>
                                <th>Date Of Avaibility</th>
                                <th>Position Applied</th>
                                <th>PHONE NUMBER</th> 
                                <th>GENDER</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>';

    // Loop through the result set and display each user
    while ($res = mysqli_fetch_array($result)) {
        echo '<tr class="active-row">
                <td>' . htmlspecialchars($res['FNAME']) . '</td>
                <td>' . htmlspecialchars($res['LNAME']) . '</td>
                <td>' . htmlspecialchars($res['EMAIL']) . '</td>
                <td>' . htmlspecialchars($res['date_available']) . '</td>
                <td>' . htmlspecialchars($res['position_applied']) . '</td>
                <td>' . htmlspecialchars($res['PHONE_NUMBER']) . '</td>
                <td>' . htmlspecialchars($res['GENDER']) . '</td>
                <td><a href="edit_user.php?email=' . urlencode($res['EMAIL']) . '">Edit</a></td>
              </tr>';
    }

    echo '</tbody></table></div></div></div></div>';

} else {
    echo "No users found.";
}

// Close the prepared statement and the database connection
mysqli_stmt_close($stmt);
mysqli_close($con);
?>
</body>
</html>
