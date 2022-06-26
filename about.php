<?php
    include 'connection.php';
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
                            <a class="nav-link active" aria-current="page"  href="about.php">ABOUT US</a>
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
                                <a href="#" class="btn-login btn btn-outline-dark container-fluid" name="btn-login">
                                    Login
                                </a>
                            </div>
                        </div>
                    </div>
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

                    <div class="right-content">
                        <h1 class="display-5 fw-bold">Sign Up</h1>          
                        <div class="content-input mt-5">
                            <div class="input-control">
                                <label for="email" class="form-label label">Display Name</label>
                                <div class="d-flex input">
                                    <span><i class="fa fas fa-user" style="color: #7D7D7D; width: 14px; height: 16px; margin-top: 4px;"></i></span>
                                    <input type="text" name="display_name" id="" class="container-fluid" placeholder="Enter your display name">
                                </div>
                            </div>
                            <div class="input-control">
                                <label for="username" class="form-label label">Username</label>
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
                                <a href="#" class="btn-login btn btn-outline-dark container-fluid" name="btn-sign">
                                    Sign Up
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section id="content">
            <div class="container">
                <div class="card py-3 px-5 m-auto rounded-3">
                    <div id="top-content">
                        <div class="d-flex">
                            <!-- tengah -->
                            <div class="m-auto"> 
                                <img src="img/logo.png" class="about-img" alt="">
                            </div>
            
                            <div class="about-text">
                                <h1 class="display-1 fw-bold mb-3 mt-3 grad-text">About Us</h1>
    
                                <p>LuxuryEstate is re-imagining real estate to make it easier to unlock life's next chapter.</p>
    
                                <p>
                                    As the most visited real estate website in the United States, Zillow and its affiliates offer custom ers an on-demand
                                    experience for selling with transparency and nearly seamless end-to-end service. provides our customers with an easy
                                    option to get pre-approved and secure financing for their next home purchase. For years, millions of home shoppers have turned to
                                    LuxuryEstate to find their dream home. realtor.coma offers a comprehensive list of
                                    for-sale properties, as well as the information and tools to make
                                    informed real estate decisions.
                                    Today, more than ever, LuxuryEstate is The Home of Home Searching
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="center-content">
                        <div class="text-center" style="margin-top: 100px; margin-bottom: 40px;">
                            <h1 class="display-3 fw-bold grad-text">Our Team</h1>
                            <p class="fs-5">Meet our team, the greatest person that work behind this project</p>
                        </div>

                        <div class="row justify-content-center align-items-center my-5">
                            <div class="col-8 col-lg-4 col-xl-3 mx-md-1 my-3">
                                <div class="card border-2 pt-4">
                                    <img src="img/kris.PNG" alt="" class="card-img-top rounded-circle team-img m-auto">
        
                                    <div class="card-body mt-3 text-center">
                                        <h5 class="card-title">Krisna Abdi Solianto</h5>
                                        <p class="card-text">Back-End Programmer</p>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-8 col-lg-4 col-xl-3 mx-md-1 my-3">
                                <div class="card border-2 pt-4">
                                    <img src="img/kris.PNG" alt="" class="card-img-top rounded-circle team-img m-auto">
        
                                    <div class="card-body mt-3 text-center">
                                        <h5 class="card-title">Krisna Abdi Solianto</h5>
                                        <p class="card-text">Back-End Programmer</p>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-8 col-lg-4 col-xl-3 mx-md-1 my-3">
                                <div class="card border-2 pt-4">
                                    <img src="img/kris.PNG" alt="" class="card-img-top rounded-circle team-img m-auto">
        
                                    <div class="card-body mt-3 text-center">
                                        <h5 class="card-title">Krisna Abdi Solianto</h5>
                                        <p class="card-text">Back-End Programmer</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-8 col-lg-4 col-xl-3 mx-md-1 my-3">
                                <div class="card border-2 pt-4">
                                    <img src="img/kris.PNG" alt="" class="card-img-top rounded-circle team-img m-auto">
        
                                    <div class="card-body mt-3 text-center">
                                        <h5 class="card-title">Krisna Abdi Solianto</h5>
                                        <p class="card-text">Back-End Programmer</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-8 col-lg-4 col-xl-3 mx-md-1 my-3">
                                <div class="card border-2 pt-4">
                                    <img src="img/kris.PNG" alt="" class="card-img-top rounded-circle team-img m-auto">
        
                                    <div class="card-body mt-3 text-center">
                                        <h5 class="card-title">Krisna Abdi Solianto</h5>
                                        <p class="card-text">Back-End Programmer</p>
                                    </div>
                                </div>
                            </div>
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