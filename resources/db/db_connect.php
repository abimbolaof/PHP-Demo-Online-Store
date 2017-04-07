<?php

	define('DB_USER', 'user');
    define('DB_PASSWORD', 'password');
    define('DB_HOST', 'dbhost.mysql.com');
    define('DB_NAME', 'db_name');

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($conn->connect_error)
        die ("Error Connecting: " . $conn->connect_error);
    //mysqli_select_db($dbc, DB_NAME);
    
?>
