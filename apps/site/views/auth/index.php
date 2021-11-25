<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: M. Maha Andar Pasaribu
* @Module       : Site
* @Type         : Auth/Login
* @Date Create	: 03 September 2018
* @Date Revise	: 20 December 2018
* @Version		: 1.0.1
* @Notes		:	+ Initial Commit
                    (Version 1.0.1) - 20 December 2018
                    + Adding Site JS
                    + Adding Language into module information
*
***/
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?=(isset($page_title) ? $page_title: ''). ' | ' .$site['title']?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">
        <meta name="author" content="<?=$site['title']?>">
        <meta name="description" content="">
        <link href="<?=base_url("assets/images/favicon.ico?v=2.1")?>" rel="icon" type="image/x-icon">
        <link href="<?=base_url("assets/login/images/stuff/logo-login.png?v=2.1")?>" rel="apple-touch-icon" sizes="57x57" />
        <link href="<?=base_url("assets/login/images/stuff/logo-login.png?v=2.1")?>" rel="apple-touch-icon" sizes="72x72" />
        <link href="<?=base_url("assets/login/images/stuff/logo-login.png?v=2.1")?>" rel="apple-touch-icon" sizes="114x114" />
        <link href="<?=base_url("assets/login/images/stuff/logo-login.png?v=2.1")?>" rel="apple-touch-icon" sizes="144x144" />
        <link href="<?=base_url("assets/login/images/stuff/logo-login.png?v=2.1")?>" rel="apple-touch-icon-precomposed" sizes="57x57" />
        <link href="<?=base_url("assets/login/images/stuff/logo-login.png?v=2.1")?>" rel="apple-touch-icon-precomposed" sizes="72x72" />
        <link href="<?=base_url("assets/login/images/stuff/logo-login.png?v=2.1")?>" rel="apple-touch-icon-precomposed" sizes="114x114" />
        <link href="<?=base_url("assets/login/images/stuff/logo-login.png?v=2.1")?>" rel="apple-touch-icon-precomposed" sizes="144x144" />
        <link rel="stylesheet" href="<?=base_url("assets/plugins/bootstrap/css/bootstrap.min.css")?>">
        <link rel="stylesheet" href="<?=base_url("assets/plugins/font-awesome/css/font-awesome.min.css")?>">
        <link rel="stylesheet" href="<?=base_url("assets/adminlte/css/AdminLTE.min.css")?>">
        <link rel="stylesheet" href="<?=base_url("assets/adminlte/css/skins/skin-blue.min.css")?>">
        <link rel="stylesheet" href="<?=base_url("assets/plugins/sweetalert2/sweetalert2.min.css")?>">

        <!--===============================================================================================-->	
            <link rel="icon" type="image/png" href="<?=base_url('assets/login/images/icons/favicon.ico')?>"/>
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="<?=base_url('assets/login/vendor/bootstrap/css/bootstrap.min.css')?>">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="<?=base_url('assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')?>">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="<?=base_url('assets/login/vendor/animate/animate.css')?>">
        <!--===============================================================================================-->	
            <link rel="stylesheet" type="text/css" href="<?=base_url('assets/login/vendor/css-hamburgers/hamburgers.min.css')?>">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="<?=base_url('assets/login/vendor/select2/select2.min.css')?>">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="<?=base_url('assets/login/css/util.css')?>">
            <link rel="stylesheet" type="text/css" href="<?=base_url('assets/login/css/main.css')?>">

            <link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/swiper/css/swiper-bundle.css')?>">
            <link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/swiper/css/swiper-bundle.min.css')?>">
        <style>
            .swiper {
            width: 100%;
            height: 100%;
            }
        </style>
        <?php
        if ( isset($site['css']) ){
            foreach($site['css'] as $css){
                $exp = explode(",", $css);
                echo "<link type=\"{$exp[0]}\" rel=\"{$exp[1]}\" href=\"{$exp[2]}\" />"."\r\n";
            }
        }
        ?>

    </head>
    <body>
        
    <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="<?= base_url('assets/login/images/agro1.png')?>" alt="IMG">
				</div>
                
                <form class="login100-form validate-form" id="form-login" action="<?=base_url("auth/signin.do")?>" method="post"> 
					<span class="login100-form-title">
						Sign In To Admin
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Username is required">
                        <input id="first-name" class="input100" type="text" name="username" placeholder="User name" autocomplete="off">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <input class="input100" type="password" name="passwd" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
                        <button id="kt_login_signin_submit" class="login100-form-btn">
							Sign in
                        </button>
					</div>

					<!-- <div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div> -->

					<div class="text-center p-t-136">
						<a class="txt2" href="https://agrointernationalacademy.com/" target="_blank">
                            Go to agrointernationalacademy.com
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
    
    <!--===============================================================================================-->	
        <script src="<?=base_url('assets/login/vendor/jquery/jquery-3.2.1.min.js') ?>"></script>
    <!--===============================================================================================-->
        <script src="<?=base_url('assets/login/vendor/bootstrap/js/popper.js') ?>"></script>
        <script src="<?=base_url('assets/login/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
    <!--===============================================================================================-->
        <script src="<?=base_url('assets/login/vendor/select2/select2.min.js') ?>"></script>
    <!--===============================================================================================-->
        <script src="<?=base_url('assets/login/vendor/tilt/tilt.jquery.min.js') ?>"></script>
        <script >
            $('.js-tilt').tilt({
                scale: 1.1
            })
        </script>
    <!--===============================================================================================-->
        <script src="<?=base_url('assets/login/js/main.js')?>"></script>

        <script src="<?=base_url('assets/login/vendor/select2/select2.min.js') ?>"></script>
        <script>
            $(".selection-2").select2({
                minimumResultsForSearch: 20,
                dropdownParent: $('#dropDownSelect1')
            });

        </script>

        <script src="<?=base_url('assets/login/js/main.js') ?>"></script>
        <script src="<?=base_url("assets/plugins/bootstrap/js/bootstrap.min.js")?>"></script>
        <script src="<?=base_url("assets/plugins/jquery-form/jquery.form.min.js")?>"></script>
        <script src="<?=base_url("assets/plugins/sweetalert2/sweetalert2.min.js")?>"></script>
        <script src="<?=base_url("assets/js/auth/login.js?v=1.00.003")?>"></script>

        
    </body>
</html>
