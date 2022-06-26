<?php
    session_start();

    $host       = "localhost";
    $db_name    = "test";
    $user       = "root";
    $password   = "";

    $conn       = mysqli_connect($host, $user, $password, $db_name);

    function moveTo($url){
        echo '<meta http-equiv="refresh" content="0; URL='.$url.'">';
    }

    function generateRandom($length = 6){
        $characters         = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength   = strlen($characters);
        $randomString       = '';
        for ($i=0; $i < $length; $i++) { 
            $randomString  .= $characters[rand(0, $charactersLength - 1)]; 
        }
        return $randomString;
    }

    function showAlert($text){
        echo '<script>alert("'.$text.'")</script>';
    }
?>

<!-- jquery cdn -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- SweetAlert cdn -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
