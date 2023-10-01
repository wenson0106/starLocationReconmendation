<?php
  session_start();
  unset($_SESSION['account']);
  unset($_SESSION['username']);
  header("Location: ./community.php");
  exit();
?>