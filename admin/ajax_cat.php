<?php

error_reporting(E_ALL);
require '../connexion.php';

$requestpayload = file_get_contents("php://input");

echo $requestpayload;
