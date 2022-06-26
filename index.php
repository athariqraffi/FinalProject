<?php
    include 'connection.php';

    $id_user = generateRandom();

    // function sign up
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
                            "Successfully creating to your account",
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
        
        <!-- fontawesome cdn -->
        <script src="https://kit.fontawesome.com/f4b0244db2.js" crossorigin="anonymous"></script>

        <!-- jquery cdn -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- sweetalert cdn -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- css & js link -->
        <link rel="stylesheet" href="assets/style.css">
        <script src="assets/script.js"></script>

        <title>Luxury - Real Estate</title>
    </head>

    <body>
        <div class="hero">
            <div class="bg-text text-center">
                <p class="display-1 text-white fw-3"> <b> Discover your new home </b></p>
                <p class="display-5 text-white"> Let's find your perfect home</p>
            </div>
        </div>
        
        <div class="content">
            <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light py-3">
                <div class="container-xl">
                    <img src="img/logo2.png" alt="" style="width: 70px; height: 50px;">
                    <a class="navbar-brand fw-600" href="#" style="color: #3884bc;">Luxury Estate</a>
                  
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item px-2">
                                <a class="nav-link active" aria-current="page" href="index.php">HOME</a>
                            </li>
                            <li class="nav-item px-3">
                                <a class="nav-link" href="catalog.php">CATALOG</a>
                            </li>
                            <li class="nav-item px-3">
                                <a class="nav-link" href="about.php">ABOUT US</a>
                            </li>
                            <li class="nav-item px-3">
                                <a class="nav-link" href="help.php">HELP</a>
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

            <section id="gallery" class="bg-light">
                <div class="container-md">
                    <div class="text-center text-md-center">
                        <h1>
                            <div class="display-5 fw-normal">Explore your home</div>
                        </h1>
                    </div>
    
                    <div class="row justify-content-center align-items-center my-5">
                        <div class="col-8 col-lg-4 col-xl-3 mx-md-1 my-3">
                            <div class="card border-2">
                                <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="" class="card-img-top">
    
                                <div class="card-body">
                                    <h5 class="card-title">$ 150.000</h5>
                                    <p class="card-text"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis repudiandae, praesentium ratione nobis consequatur ipsam.</p>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-8 col-lg-4 col-xl-3 mx-md-1 my-3">
                            <div class="card border-2">
                                <img src="https://images.unsplash.com/photo-1560185893-a55cbc8c57e8?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="" class="card-img-top">
    
                                <div class="card-body">
                                    <h5 class="card-title">$ 250.000</h5>
                                    <p class="card-text"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui nisi explicabo reprehenderit saepe labore quis.</p>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-8 col-lg-4 col-xl-3 mx-md-1 my-3">
                            <div class="card border-2">
                                <img src="https://images.unsplash.com/photo-1587985064135-0366536eab42?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="" class="card-img-top">
    
                                <div class="card-body">
                                    <h5 class="card-title">$ 500.000</h5>
                                    <p class="card-text"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto aspernatur rerum dolores distinctio quibusdam iure.</p>
                                </div>
                            </div>
                        </div>
    
                        <div class="text-center mt-5">
                            <a href="catalog.php" class="btn btn-outline-dark m-auto p-2 px-3">View More</a>
                        </div>
                    </div>
                </div>
            </section>
    
            <section id="features">
                <div class="container-fluid px-5">
                    <div class="row justify-content-center align-items-center mb-5 slideinleft">
                        <div class="col-md-5 ">
                            <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" 
                            class="img-fluid" alt="">
                        </div>
    
                        <div class="col-md-5 text-center mx-2 my-3">
                            <h1>
                                <div class="display-6"><span class="fw-bold">BUYING </span>HOME MADE <span class="fw-bold">SIMPLE</span></div>
                            </h1>
                            <P class="pt-4">
                                Browse the highest quality listings, look out for yourself, easy payment, get your dream home. 
                            </P>
                        </div>
                    </div>
    
                    <div class="row justify-content-center align-items-center slideinright">
                        <div class="col-md-5 text-center mx-2 my-3">
                            <h1>
                                <div class="display-6"><span class="fw-bold">100%</span> LEGAL</div>
                            </h1>
                            <P class="pt-4">
                                All transaction under the laws of the country, you don't need to worry.   
                            </P>
                        </div>
    
                        <div class="col-md-5">
                            <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" 
                            class="img-fluid" alt="">
                        </div>
                    </div>
    
                    <div class="row justify-content-center align-items-center mb-5 slideinleft">
                        <div class="col-md-5">
                            <img src="https://images.unsplash.com/photo-1558403194-611308249627?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" 
                            class="img-fluid" alt="">
                        </div>
    
                        <div class="col-md-5 text-center mx-2 my-3">
                            <h1>
                                <div class="display-6">We please <span class="fw-bold">your needs</span></div>
                            </h1>
                            <P class="pt-4">
                                We have sold endless properties, we are not letting you down.
                            </P>
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
        </div>

        
    </body>
</html>