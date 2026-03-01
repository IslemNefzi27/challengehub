<?php
session_start();
if(!isset($_SESSION['email'])){
    header('Location: connexion.html');
    exit();
}
require_once '../models/usermodel.php';
$servername="localhost";
$username="root";
$password="";
$database="challengehub";