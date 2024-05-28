<?php
session_start();

if (isset($_GET['logout'])) {
   unset($_SESSION['User']);
   unset($_SESSION['Adm']);
   unset($_SESSION['Agency']);
   session_unset();
   session_destroy();
   header("refresh: 2; url = ../user/login.php");
}
