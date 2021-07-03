<?php
$conn = new PDO('mysql:host=HOSTNAME;DBNAME',"PASS","USER");
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$_SESSION['db']=$conn;
