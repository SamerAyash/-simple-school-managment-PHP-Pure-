<!DOCTYPE html>

<html lang="en" >
<!--begin::Head-->
<head>
    <meta charset="utf-8"/>
    <title>Student | Login</title>
    <meta name="description" content="Login page example"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!--end::Fonts-->
    <?php $host= 'http://localhost/school_managment';?>
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="<?php echo $host ?>/assets/css/pages/login/classic/login-4.css" rel="stylesheet" type="text/css"/>
    <!--end::Page Custom Styles-->

    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="<?php echo $host ?>/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $host ?>/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $host ?>/assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <!--end::Global Theme Styles-->

    <!--begin::Layout Themes(used by all pages)-->

    <link href="<?php echo $host ?>/assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $host ?>/assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $host ?>/assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $host ?>/assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css"/>
    <!--end::Layout Themes-->

    <link rel="shortcut icon" href="<?php echo $host ?>/assets/media/logos/favicon.ico"/>

</head>
<!--end::Head-->
<?php
require_once "../config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    unset($_SESSION['user_name']);
    unset($_SESSION['user_id']);
    unset($_SESSION['user_type']);
    unset($_SESSION['error']);
    // Escape user inputs for security
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

// Query the database to find a matching user
    $sql = "SELECT * FROM students WHERE email='$email' AND password='$password'";
    $result = mysqli_query($connection, $sql);

// If a matching user is found, start a session and redirect to the homepage
    if (mysqli_num_rows($result) == 1) {
        $user= mysqli_fetch_assoc($result);
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_type'] = "student";
        header("Location: ".$host."/student");
    } else {
        // If no matching user is found, display an error message
        $_SESSION['error']= "Invalid username or password";
    }
}
?>
<!--begin::Body-->
<body  id="kt_body"  class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading"  >

<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
        <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('<?php echo $host ?>/assets/media/bg/bg-5.jpg');">

            <div class="login-form text-center p-7 position-relative overflow-hidden">
                <!--begin::Login Header-->
                <div class="d-flex flex-center mb-10">
                    <div class="symbol symbol-150 mr-3 symbol-circle">
                        <div class="symbol-label" style="background-image: url("")></div>
                    </div>
                </div>
                <!--end::Login Header-->

                <!--begin::Login Sign in form-->
                <div class="login-signin">
                    <div class="mb-10 text-white font-weight-bold">
                        <h3>Welcome Student</h3>
                        <div class="text-white font-weight-bold">Enter your information to login to your account</div>
                    </div>
                    <form class="form" action="<?php echo $host?>/student/login.php" method="post">
                        <?php
                        if (!isset($_SESSION['csrf_token'])) {
                            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                        }
                        ?>
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <div class="form-group mb-5">
                            <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Email" name="email" autocomplete="on" />
                        </div>
                        <div class="form-group mb-5">
                            <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Password" name="password" />
                        </div>
                        <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                            <div class="checkbox-inline">
                                <label class="checkbox m-0 text-white">
                                    <input type="checkbox" name="remember" />
                                    <span></span>
                                    Remember me
                                </label>
                            </div>
                            <a href="#" class="text-white text-hover-primary">Are you forgot a password!</a>
                        </div>
                        <?php if (isset($_SESSION['error']) && $_SESSION['error']){
                            echo '<div class="alert alert-danger">'.$_SESSION['error'].'</div>';
                        }?>
                        <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Sign in</button>
                    </form>
                </div>
                <!--end::Login Sign in form-->
            </div>
        </div>
    </div>
    <!--end::Login-->
</div>
<!--end::Main-->

<!--begin::Global Theme Bundle(used by all pages)-->
<script src="<?php echo $host ?>/assets/plugins/global/plugins.bundle.js"></script>
<script src="<?php echo $host ?>/assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
<script src="<?php echo $host ?>/assets/js/scripts.bundle.js"></script>
<!--end::Global Theme Bundle-->

<!--begin::Page Scripts(used by this page)-->
<script src="<?php echo $host ?>/assets/js/pages/custom/login/login-general.js"></script>
<!--end::Page Scripts-->
</body>
<!--end::Body-->
</html>



