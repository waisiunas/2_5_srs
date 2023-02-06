<?php require_once './database/connection.php'; ?>

<?php

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $reg_id = $_GET['id'];
} else {
    header('location: ./show_registrations.php');
}

$sql = "DELETE FROM `registrations` WHERE `id` = $reg_id";

if($conn->query($sql)) {
    header('location: ./show_registrations.php');
} else {
    echo 'Failed to delete';
}