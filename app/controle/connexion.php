<?php
require("../app/models/usermodel.php");
session_start();
$usermodel=new usermodel($conn);
$email=$_POST['email'];
$password=$_POST['motdepasse'];
$user=$usermodel->trouvepemail($email);
if($user){
    if(password_verify($password, $user['mot_passe']))
        {$_SESSION['email']=$email;
        header('Location: challenge.php');
        exit();
    }else{
        header('Location: connexion.html');
        exit();
    }
}
else{
    header('Location: connexion.html');
    exit();
}
?>