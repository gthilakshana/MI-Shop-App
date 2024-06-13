<!DOCTYPE html>



<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Login Form | CodingLab</title> -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="icon" href="resources/2514356.png" />
</head>




<body class="main-body">

    <div class="container-fluid">


        <br>
        <div class="row">
            <div class="col-12 logo">
                
            </div>
        </div>
        <br>







        <div class="container">
            <div class="row justify-content-center">

                <div class="col-12 col-sm-12 col-md-10 col-lg-5" id="signUpBox">
                    <div class="signup-form ">
                        <form class="form">
                            <h4 class="mb-5 text-warning text-center " id="msg">Create New Account</h4>
                            <div class="row g-2">



                                <div class="col-6">
                                    <label class="form-label">First Name<span class="text-primary">*</span></label>
                                    <input class="form-control" type="text" placeholder="First Name" id="fname" />
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Last Name<span class="text-primary">*</span></label>
                                    <input class="form-control" type="text" placeholder="Last Name" id="lname" />
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Email<span class="text-primary">*</span></label>
                                    <input class="form-control" type="email" placeholder="Email" id="email" />
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Password<span class="text-primary">*</span></label>
                                    <input class="form-control" type="password" placeholder="Password" id="password" />
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Mobile<span class="text-primary">*</span></label>
                                    <input class="form-control" type="number" placeholder="Mobile" id="mobile" />
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Gender<span class="text-primary">*</span></label>
                                    <select class="form-select" id="gender">

                                        <?php

                                        require "connection.php";

                                        $r = Database::search("SELECT * FROM `gender`");
                                        $n = $r->num_rows;

                                        for ($x = 0; $x < $n; $x++) {
                                            $d = $r->fetch_assoc();

                                        ?>
                                            <option value="<?php echo $d["id"]; ?>"><?php echo $d["name"]; ?></option>
                                        <?php
                                        }

                                        ?>

                                    </select>


                                </div>

                                <div class="col-12 mt-4 d-grid">
                                    <button class="btn btn-warning float-end" onclick="signUp();">Sign Up</button>
                                </div>

                            </div>
                            <p class="text-center mt-3 text-secondary" onclick="changeView();">If you have account, Please<a href="#" class="text-danger"> Login Now</a></p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="container">
        <div class="row justify-content-center">

            <div class="col-10 col-sm-10 col-md-12 col-lg-6 d-none d-grid" id="signInBox">

                <div class="row form2">

                    <div class="col-md-6 offset-md-2"> </div>


                    <form class="p-3">

                        <div class="col-12 col-md-6 col-lg-12">
                            <p class="title02 text-warning text-center" id="msg2">Sign In to Your Account</p>
                            <span class="text-danger"></span>
                        </div>

                        <hr>
                        <?php

                        $email = "";
                        $password = "";

                        if (isset($_COOKIE["email"])) {
                            $email = $_COOKIE["email"];
                        }

                        if (isset($_COOKIE["password"])) {
                            $password = $_COOKIE["password"];
                        }

                        ?>





                        <div class="col-12">
                            <label class="form-label text-dark">Email</label>
                            <input class="form-control" type="email" id="email2" placeholder="Email" value="<?php echo $email ?>" />
                        </div>
                        </br>
                        <div class="col-12">
                            <label class="form-label text-dark">Password</label>
                            <input class="form-control" type="password" id="password2" placeholder="Password" value="<?php echo $password ?>" />
                        </div>
                        </br>
                        <div class="col-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" value="1" id="rememberMe" />
                                <label class="form-check-label">Remember Me</label>
                            </div>
                        </div>
                        </br>
                        <div class="col-12">
                            <a href="#" class="link-warning" onclick="forgotpassword();">Fogot Password</a>
                        </div>


                        <div class="col-12 d-grid">
                            <button class="btn btn-warning d-grid" onclick="signIn();">Sign In</button>
                        </div>



                        <hr>

                        <p class="text-center mb-0 text-secondary" onclick="changeView();">If you have not account <a href="#" class="text-danger">Register Now</a></p>

                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>
    </div>

  

    <!-- footer -->

    <div class="col-12 d-none d-lg-block fixed-bottom">
        <p class="text-end">&copy; 2022 mishop.lk All Rights Reserved</p>

    </div>

    <!-- footer -->

    <!-- modal -->

    <div class="modal" tabindex="-1" id="forgotPasswordModa1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Password Reset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-6">
                            <label class="form-label">New Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="np" />
                                <button class="btn-outline-primary" type="button" id="npb" onclick="showPassword1();">Show</button>
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="form-label">Re-Type Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="rnp" />
                                <button class="btn-outline-primary" type="button" id="rnpb" onclick="showPassword2();">Show</button>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Verification Code</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="vc" />
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset</button>
                </div>
            </div>
        </div>
    </div>


    <!-- modal -->

    </div>
    </div>








    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>