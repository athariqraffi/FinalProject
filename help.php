<?php
    include 'connection.php';

    $id_feed    = generateRandom();
    // function sign 
    if(isset($_POST['signBtn'])){

        $dspName    = $_POST['display-name'];
        $username   = $_POST['username'];
        $password   = $_POST['password'];

        $sql        = "INSERT INTO user (id_user, display_name, username, password) VALUES ('$id_user', '$dspName', '$username', '$password')";

        mysqli_query($conn, $sql);

        if($sql){
            echo '
                <script>
                    $(document).ready(function(){
                        Swal.fire(
                            "Success",
                            "Successfully login to your account",
                            "success"
                        )
                    });
                </script>
            ';

        } else {
            echo '
                <script>
                    $(document).ready(function(){
                        Swal.fire(
                            "Failed",
                            "Failed to login to your account",
                            "error"
                        )
                    });
                </script>
            ';
        }

    }

    // function login 
    if(isset($_POST['loginBtn'])){
        $username   = $_POST['username'];
        $password   = $_POST['password'];
        
        $sql        = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");

        //mengecek jumlah data di database dengan menghitung 
            //jumlah baris yang isinya sama dengan data user yang login
        $row        = mysqli_num_rows($sql);

        //jika data di database tidak kosong
        if($row > 0){
            
            $data   = mysqli_fetch_assoc($sql);

            $_SESSION['id_user']        = $data['id_user'];
            $_SESSION['display_name']   = $data['display_name'];
            $_SESSION['username']       = $data['username'];
            $_SESSION['logged']         = true;

            echo '
            <script>
                $(document).ready(function(){
                    Swal.fire(
                        "Success",
                        "Successfully login to your account",
                        "success"
                    )
                });
            </script>
            ';

        } else {
            echo '
            <script>
                $(document).ready(function(){
                    Swal.fire(
                        "Failed",
                        "Failed to login to your account",
                        "error"
                    )
                });
            </script>
            ';
        }
    }

    // function send feedback
    if(isset($_POST['send'])){

        if(isset($_SESSION['logged'])){
            $id_user    = $_SESSION['id_user'];
            $email      = $_POST['email-feed'];
            $message    = $_POST['comment-feed'];
    
            $sql        = "INSERT INTO feedback (id_feed, message, email, id_user) VALUES ('$id_feed', '$message', '$email', '$id_user')";
    
            mysqli_query($conn, $sql);
    
            echo '
                <script>
                    $(document).ready(function(){
                        Swal.fire(
                            "Success",
                            "Successfully send your feedback",
                            "success"
                        )
                    });
                </script>
            ';
        } else {
            echo '
                <script>
                    $(document).ready(function(){
                        Swal.fire(
                            "Failed",
                            "You need to login to send your feedback",
                            "error"
                        )
                    });
                </script>
            ';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- bootstrap css cdn  -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        
        <!-- bootstrap javascript cdn  -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        
        <!-- jquery cdn -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- fontawesome cdn -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- sweetalert cdn -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        
        <!-- css & js link -->
        <link rel="stylesheet" href="assets/style.css">
        <script src="assets/script.js"></script>

        <title>Luxury - Real Estate</title>
    </head>

    <body>
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
            <div class="container-xl">
                <img src="img/logo2.png" alt="" style="width: 70px; height: 50px;">
                <a class="navbar-brand fw-600" href="#" style="color: #3884bc;">Luxury Estate</a>
              
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item px-2">
                            <a class="nav-link" href="index.php">HOME</a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link" href="catalog.php">CATALOG</a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link"  href="about.php">ABOUT US</a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link active" aria-current="page" href="help.php">HELP</a>
                        </li>
                    </ul>
                </div>

                <?php
                    if(isset($_SESSION['logged'])){
                        $dspName    = $_SESSION['display_name'];
                        echo "
                            <div class= 'collapse navbar-collapse justify-content-end'>
                                <ul class='navbar-nav mx-3'>
                                    <li class='nav-item m-auto mt-3'>
                                        <p class='pe-3'>
                                            Hello, $dspName
                                        </p>
                                    </li>
                                    <li class='nav-item dropdown'>
                                        <a href='#' class='nav-link dropdown-toggle m-auto' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                            <span><i class='fa-regular fa-circle-user fs-2 fw-normal'></i></span>
                                        </a>
                                        <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                            <li>
                                                <div class='d-flex'>
                                                    <a class='dropdown-item' href='logout.php'>
                                                        <span class='m-auto me-2'>
                                                            <i class='fa fa-power-off fs-6'></i>                       
                                                        </span>
                                                        Log Out
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        ";
                        
                    } else {
                        echo '
                            <div class="collapse navbar-collapse justify-content-end">
                                <ul class="navbar-nav mx-3">
                                    <li class="nav-item">
                                        <a class="py-1 px-3 btn-contact" role="button" style="border-radius: 15px; font-size: 11pt;" href="#" id="login-btn">Sign In</a>
                                    </li>
                                </ul>
        
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="py-1 px-3 btn-contact" role="button" style="border-radius: 10px; font-size: 12pt;" href="#" id="signUp-btn">Sign Up</a>
                                    </li>
                                </ul>
                            </div>
                        ';
                    }
                ?>
            </div>
        </nav>

        <!-- Modal Login -->
        <div class="modal" id="myModalLogin">
            <div class="primary-box d-flex" id="myModal">
                <div class="left-box text-center">
                    <img src="img/login-img.jpg" alt="">
                </div>

                <div class="right-box">
                    <div class="header">
                        <button class="btn-close" id="loginClose-btn"></button>
                    </div>
                    <form action="" method="POST">
                        <div class="right-content">
                            <h1 class="display-5 fw-bold">Login</h1>          
                            <div class="content-input mt-5">
                                <div class="input-control">
                                    <label for="email" class="form-label label">Username</label>
                                    <div class="d-flex input">
                                        <span><i class="fa fas fa-user" style="color: #7D7D7D; width: 14px; height: 16px; margin-top: 4px;"></i></span>
                                        <input type="text" name="username" id="" class="container-fluid" placeholder="Enter your username">
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="password" class="form-label label">Password</label>
                                    <div class="d-flex input">
                                        <span><i class="fa fas fa-lock" style="color: #7D7D7D; width: 14px; height: 16px; margin-top: 7px;"></i></span>
                                        <input type="password" name="password" id="" class="container-fluid" placeholder="Enter your password">
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <input type="submit" class="btn-login btn btn-outline-dark container-fluid" value="Login" name="loginBtn">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Sign Up -->
        <div class="modal"  id="myModalSign">
            <div class="primary-box d-flex"">
                <div class="left-box text-center">
                    <img src="img/signUp-img.jpg" alt="">
                </div>
                <div class="right-box">
                    <div class="header">
                        <button class="btn-close" id="signClose-btn"></button>
                    </div>
                    <form action="" method="POST" id="signForm">
                        <div class="right-content">
                            <h1 class="display-5 fw-bold">Sign Up</h1>          
                            <div class="content-input mt-5">
                                <div class="input-control">
                                    <label for="email" class="form-label label">Display Name</label>
                                    <div class="d-flex input">
                                        <span><i class="fa fas fa-user" style="color: #7D7D7D; width: 14px; height: 16px; margin-top: 4px;"></i></span>
                                        <input type="text" name="display-name" id="" class="container-fluid" placeholder="Enter your display name" required>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="username" class="form-label label">Username</label>
                                    <div class="d-flex input">
                                        <span><i class="fa fas fa-user" style="color: #7D7D7D; width: 14px; height: 16px; margin-top: 4px;"></i></span>
                                        <input type="text" name="username" id="" class="container-fluid" placeholder="Enter your username" required>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="password" class="form-label label">Password</label>
                                    <div class="d-flex input">
                                        <span><i class="fa fas fa-lock" style="color: #7D7D7D; width: 14px; height: 16px; margin-top: 7px;"></i></span>
                                        <input type="password" name="password" id="" class="container-fluid" placeholder="Enter your password" required>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <input type="submit" class="btn-login btn btn-outline-dark container-fluid" value="Sign Up" name="signBtn">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <section>
            <div class="container">
                <div class="card p-4">
                    <div class="card-title text-center">
                        <h1 class="display-5 fw-normal">Tell Us</h1>
                        <p>Give your feedback about us, your feedback will help us to improve our management</p>
                    </div>
                    
                    <div class="card-body">
                        <div class="form-input m-auto">
                            <form action="" method="POST">
                                <div class="input-control">
                                    <label for="email" class="fs-6 fw-bold mb-3 mt-3">Email</label>
                                    <div class="input">
                                        <input type="email" name="email-feed" class="container-fluid" placeholder="example@email.com">
                                    </div>
                                </div>

                                <?php
                                    if(isset($_SESSION['logged'])){
                                        $name   = $_SESSION['display_name'];
                                        echo "
                                        <div class='input-control'>
                                            <label for='name' class='fs-6 mb-3 fw-bold mt-3'>Name</label>
                                            <div class='input'>
                                                <input type='text' name='name-feed' class='container-fluid' value='$name' >
                                            </div>
                                        </div>
                                        ";
                                    } else {
                                        echo "
                                        <div class='input-control'>
                                            <label for='name' class='fs-6 mb-3 fw-bold mt-3'>Name</label>
                                            <div class='input'>
                                                <input type='text' name='name-feed' class='container-fluid' placeholder='Your Name'>
                                            </div>
                                        </div>
                                        ";
                                    }
                                ?>
                                
                                <div class="input-control">
                                    <label for="comment" class="fs-6 mb-3 fw-bold mt-3">Comment</label>
                                    <div class="input">
                                        <textarea name="comment-feed" id="" cols="30" rows="10" class="container-fluid" placeholder="Your Feedback"></textarea>
                                    </div>
                                </div>
                                <div class="input-control float-end mt-5">
                                    <button class="btn btn-outline-primary px-4 py-2 me-2" type="reset">Reset</button>
                                    <button class="btn btn-primary px-4 py-2" type="submit" name="send">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
    
                </div>

            </div>
        </section>


        <div class="container-fluid text-center my-5">
            <h2>LuxuryEstate</h2>
            <div class="d-flex">
                <img src="" alt="">
            </div>
            <h6>2022 All Rights Reserved</h1>
        </div>
    </body>
</html>