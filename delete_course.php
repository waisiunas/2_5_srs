<?php require_once './database/connection.php'; ?>

<?php

if (isset ($_GET['id']) && !empty ($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
} else {
    header('Location: ./show_courses.php');
}

$sql = "DELETE FROM `courses` WHERE `id` = $id";

if ($conn->query($sql)) {
    header('Location: ./show_courses.php');
} else {
    echo 'Course has failed to delete';
}