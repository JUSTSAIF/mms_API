<?php
$conn = new PDO('mysql:host=localhost;dbname=mr28-loginSys',"root",'');
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$_SESSION['db']=$conn;
