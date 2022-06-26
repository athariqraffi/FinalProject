<?php
    include 'connection.php';

    session_destroy();
    moveTo('index.php');
?>