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
                            <a class="nav-link" href="index.php">HOME</a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link active" aria-current="page" href="catalog.php">CATALOG</a>
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

        <section id="high-sect">
            <div class="container-fluid">
                <div class="text-center mt-5 mb-5">
                    <h1 class="display-4 fw-normal">Browse your future home</h1>
                </div>
                
                <h1 class="display-5" style="margin-left: 210px; margin-bottom: 50px;">High End</h1>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="anch_high" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-4">
                                                <div class="card m-auto" style="width: 350px;">
                                                    <img src="https://images1.loopnet.com/i2/iGOf21Oe-ADlOKDJanNkThe1twpAD0DVKLp3wd2ogFw/110/1126-Folsom-St-San-Francisco-CA-Primary-Photo-1-Large.jpg" class="card-img-top m-auto" alt="">

                                                    <div class="card-body">
                                                        <h4 class="card-title ">
                                                            $ 5.550.000
                                                        </h4>

                                                        <p class="card-text">
                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, provident?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-lg-4">
                                                <div class="card m-auto" style="width: 350px;">
                                                    <img src="https://images1.loopnet.com/i2/TxX2PEHBlC_DN7du1Jb-wUgScdSC0outZQ11GJtX30Q/116/500-Masonic-Ave-San-Francisco-CA-Primary-Photo-1-LargeHighDefinition.jpg" class="card-img-top m-auto" alt="">

                                                    <div class="card-body">
                                                        <h4 class="card-title ">
                                                            $ 4.750.000
                                                        </h4>

                                                        <p class="card-text">
                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, provident?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-lg-4">
                                                <div class="card m-auto" style="width: 350px;">
                                                    <img src="https://images1.loopnet.com/i2/-U7crqHct1ys2u7EWVwp5ccbdcVajhglAY7qBykjs4Y/117/office-property-for-sale-42-dore-st-san-francisco-ca-94103.jpg" class="card-img-top m-auto" alt="">

                                                    <div class="card-body">
                                                        <h4 class="card-title ">
                                                            $ 3.750.000
                                                        </h4>

                                                        <p class="card-text">
                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, provident?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-4">
                                                <div class="card m-auto" style="width: 350px;">
                                                    <img src="https://images1.loopnet.com/i2/BdQZHh1_eZ403U7pRxJk4zGmhG5z1ig9II5VMkrEwOA/116/401-403-32nd-Ave-San-Francisco-CA-aa_0006-1-LargeHighDefinition.jpg
                                                    " class="card-img-top m-auto" alt="">

                                                    <div class="card-body">
                                                        <h4 class="card-title ">
                                                            $ 2.080.000
                                                        </h4>

                                                        <p class="card-text">
                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, provident?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-lg-4">
                                                <div class="card m-auto" style="width: 350px;">
                                                    <img src="https://images.unsplash.com/photo-1583608205776-bfd35f0d9f83?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" class="card-img-top m-auto" alt="">

                                                    <div class="card-body">
                                                        <h4 class="card-title ">
                                                            $ 1.780.000
                                                        </h4>

                                                        <p class="card-text">
                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, provident?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-lg-4">
                                                <div class="card m-auto" style="width: 350px;">
                                                    <img src="https://images.unsplash.com/photo-1582063289852-62e3ba2747f8?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" class="card-img-top m-auto" alt="">

                                                    <div class="card-body">
                                                        <h4 class="card-title ">
                                                            $ 1.080.000
                                                        </h4>

                                                        <p class="card-text">
                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, provident?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#anch_high" data-bs-slide="prev">
                                <span class="fa fa-angle-left" style="font-size: 32pt; color: black;" aria-hidden="true"></span>
                            </button>

                            <button class="carousel-control-next" type="button" data-bs-target="#anch_high" data-bs-slide="next">
                                <span class="fa fa-angle-right" style="font-size: 32pt; color: black;" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="mid-sect">
            <div class="container-fluid">
                <h1 class="display-5" style="margin-left: 210px; margin-bottom: 50px;">Middle Class</h1>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="anch_middle" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-4">
                                                <div class="card m-auto" style="width: 350px;">
                                                    <img src="https://images1.loopnet.com/i2/iGOf21Oe-ADlOKDJanNkThe1twpAD0DVKLp3wd2ogFw/110/1126-Folsom-St-San-Francisco-CA-Primary-Photo-1-Large.jpg" class="card-img-top m-auto" alt="">

                                                    <div class="card-body">
                                                        <h4 class="card-title ">
                                                            $ 5.550.000
                                                        </h4>

                                                        <p class="card-text">
                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, provident?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-lg-4">
                                                <div class="card m-auto" style="width: 350px;">
                                                    <img src="https://images1.loopnet.com/i2/TxX2PEHBlC_DN7du1Jb-wUgScdSC0outZQ11GJtX30Q/116/500-Masonic-Ave-San-Francisco-CA-Primary-Photo-1-LargeHighDefinition.jpg" class="card-img-top m-auto" alt="">

                                                    <div class="card-body">
                                                        <h4 class="card-title ">
                                                            $ 4.750.000
                                                        </h4>

                                                        <p class="card-text">
                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, provident?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-lg-4">
                                                <div class="card m-auto" style="width: 350px;">
                                                    <img src="https://images1.loopnet.com/i2/-U7crqHct1ys2u7EWVwp5ccbdcVajhglAY7qBykjs4Y/117/office-property-for-sale-42-dore-st-san-francisco-ca-94103.jpg" class="card-img-top m-auto" alt="">

                                                    <div class="card-body">
                                                        <h4 class="card-title ">
                                                            $ 3.750.000
                                                        </h4>

                                                        <p class="card-text">
                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, provident?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-4">
                                                <div class="card m-auto" style="width: 350px;">
                                                    <img src="https://images1.loopnet.com/i2/BdQZHh1_eZ403U7pRxJk4zGmhG5z1ig9II5VMkrEwOA/116/401-403-32nd-Ave-San-Francisco-CA-aa_0006-1-LargeHighDefinition.jpg
                                                    " class="card-img-top m-auto" alt="">

                                                    <div class="card-body">
                                                        <h4 class="card-title ">
                                                            $ 2.080.000
                                                        </h4>

                                                        <p class="card-text">
                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, provident?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-lg-4">
                                                <div class="card m-auto" style="width: 350px;">
                                                    <img src="https://images.unsplash.com/photo-1583608205776-bfd35f0d9f83?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" class="card-img-top m-auto" alt="">

                                                    <div class="card-body">
                                                        <h4 class="card-title ">
                                                            $ 1.780.000
                                                        </h4>

                                                        <p class="card-text">
                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, provident?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-lg-4">
                                                <div class="card m-auto" style="width: 350px;">
                                                    <img src="https://images.unsplash.com/photo-1582063289852-62e3ba2747f8?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" class="card-img-top m-auto" alt="">

                                                    <div class="card-body">
                                                        <h4 class="card-title ">
                                                            $ 1.080.000
                                                        </h4>

                                                        <p class="card-text">
                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, provident?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#anch_middle" data-bs-slide="prev">
                                <span class="fa fa-angle-left" style="font-size: 32pt; color: black;" aria-hidden="true"></span>
                            </button>

                            <button class="carousel-control-next" type="button" data-bs-target="#anch_middle" data-bs-slide="next">
                                <span class="fa fa-angle-right" style="font-size: 32pt; color: black;" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="low-sect">
            <div class="container-fluid">
                <h1 class="display-5" style="margin-left: 210px; margin-bottom: 50px;">Low Section</h1>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="anch_low" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-4">
                                                <div class="card m-auto" style="width: 350px;">
                                                    <img src="https://images1.loopnet.com/i2/iGOf21Oe-ADlOKDJanNkThe1twpAD0DVKLp3wd2ogFw/110/1126-Folsom-St-San-Francisco-CA-Primary-Photo-1-Large.jpg" class="card-img-top m-auto" alt="">

                                                    <div class="card-body">
                                                        <h4 class="card-title ">
                                                            $ 5.550.000
                                                        </h4>

                                                        <p class="card-text">
                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, provident?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-lg-4">
                                                <div class="card m-auto" style="width: 350px;">
                                                    <img src="https://images1.loopnet.com/i2/TxX2PEHBlC_DN7du1Jb-wUgScdSC0outZQ11GJtX30Q/116/500-Masonic-Ave-San-Francisco-CA-Primary-Photo-1-LargeHighDefinition.jpg" class="card-img-top m-auto" alt="">

                                                    <div class="card-body">
                                                        <h4 class="card-title ">
                                                            $ 4.750.000
                                                        </h4>

                                                        <p class="card-text">
                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, provident?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-lg-4">
                                                <div class="card m-auto" style="width: 350px;">
                                                    <img src="https://images1.loopnet.com/i2/-U7crqHct1ys2u7EWVwp5ccbdcVajhglAY7qBykjs4Y/117/office-property-for-sale-42-dore-st-san-francisco-ca-94103.jpg" class="card-img-top m-auto" alt="">

                                                    <div class="card-body">
                                                        <h4 class="card-title ">
                                                            $ 3.750.000
                                                        </h4>

                                                        <p class="card-text">
                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, provident?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-4">
                                                <div class="card m-auto" style="width: 350px;">
                                                    <img src="https://images1.loopnet.com/i2/BdQZHh1_eZ403U7pRxJk4zGmhG5z1ig9II5VMkrEwOA/116/401-403-32nd-Ave-San-Francisco-CA-aa_0006-1-LargeHighDefinition.jpg
                                                    " class="card-img-top m-auto" alt="">

                                                    <div class="card-body">
                                                        <h4 class="card-title ">
                                                            $ 2.080.000
                                                        </h4>

                                                        <p class="card-text">
                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, provident?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-lg-4">
                                                <div class="card m-auto" style="width: 350px;">
                                                    <img src="https://images.unsplash.com/photo-1583608205776-bfd35f0d9f83?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" class="card-img-top m-auto" alt="">

                                                    <div class="card-body">
                                                        <h4 class="card-title ">
                                                            $ 1.780.000
                                                        </h4>

                                                        <p class="card-text">
                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, provident?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-lg-4">
                                                <div class="card m-auto" style="width: 350px;">
                                                    <img src="https://images.unsplash.com/photo-1582063289852-62e3ba2747f8?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" class="card-img-top m-auto" alt="">

                                                    <div class="card-body">
                                                        <h4 class="card-title ">
                                                            $ 1.080.000
                                                        </h4>

                                                        <p class="card-text">
                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, provident?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#anch_low" data-bs-slide="prev">
                                <span class="fa fa-angle-left" style="font-size: 32pt; color: black;" aria-hidden="true"></span>
                            </button>

                            <button class="carousel-control-next" type="button" data-bs-target="#anch_low" data-bs-slide="next">
                                <span class="fa fa-angle-right" style="font-size: 32pt; color: black;" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>