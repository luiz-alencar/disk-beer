<?php
if(!isset($_SESSION)){
    session_start();
}

unset($_SESSION);
session_destroy();
$_SESSION = array();
header('Location: ../public/index.php');
exit;

?>