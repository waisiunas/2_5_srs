<?php require_once './database/connection.php'; ?>

<?php

if (isset ($_GET['id']) && !empty ($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
} else {
    header('Location: ./show_students.php');
}

$sql = "DELETE FROM `students` WHERE `id` = $id";

if ($conn->query($sql)) {
    header('Location: ./show_students.php');
} else {
    echo 'Student has failed to delete';
}