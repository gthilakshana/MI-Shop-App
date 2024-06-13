<!DOCTYPE html>
<html>

<head>
    <title>MI SHOP | Admin Sign IN</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style1.css" />
</head>

<body>

    <?php
    require "header.php";
    ?>

    <div class="container-fluid justify-content-center" style="margin-top: 100px;">

        <div class="row align-content-center">

            <div class="col-12">

                <div class="row">

                    <div class="col-12 "></div>

                    <div class="col-12">
                        <p class="text-center text-dark fw-bold fs-1">Hi, Wellcome To MI SHOP Admins</p>
                    </div>

                </div>

            </div>
            <hr>
            <br>
            <div class="col-8 p-5">
                <div class="row ">

                    <div class="col-6 d-none d-lg-block background"></div>

                    <div class="col-12 col-lg-6 d-block">
                        <div class="row g-3">

                            <div class="col-12">
                                <p class="title01 fw-bold">Sign In To Your Account</p>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" id="e" class="form-control" />
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-dark" onclick="adminVerification();">Send Verification Code </button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-warning">back to customer Log IN</button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="modal" tabindex="-1" id="verification_model">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Admin Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Enter the verification code you got by the email</label>
                            <input type="text" class="form-control" id="vcode" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-warning" onclick="verify();">Verify</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 d-none d-lg-block fixed-bottom text-center">
                <p >&copy; 2022 MI SHOP.lk All Rights Reserved.</p>
            </div>

        </div>

    </div>


    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>