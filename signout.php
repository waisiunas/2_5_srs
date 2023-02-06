<?php require_once 'database/connection.php'; ?>

<?php

session_start();
unset($_SESSION['admin_id']);
header('location: ./sign-in.php');