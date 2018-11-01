<?php
if(!empty($_POST['login'])&&!empty($_POST['password'])){
    $user = $_POST["login"];
    $pass = $_POST["password"];
    $p=new mysqli ("localhost","root","","sitedb");
    $q = "select password from users where user='$user'";
    $w = $p->query($q);
    $w = $w->fetch_array();
    if($w[0]==$pass){
        session_start();
        $_SESSION['user'] = $user;
        header("Location: index.php");
    }else{
        echo "błędne hasło";
        require_once("index.php");
    }
}else{
header("Location: index.php");
}
?>