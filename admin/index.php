<?php require '../layout/app.php';?>
<?php
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    $url= $host.'/admin/login.php';
    echo '<script>location.replace("'.$url.'");</script>';
}
?>
    <!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-6  subheader-solid " id="kt_subheader">
            <div
                class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">

                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->
                        <h5 class="text-dark font-weight-bold my-1 mr-5">
                            Dashboard
                        </h5>
                        <!--end::Page Title-->

                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="index.php" class="text-muted">
                                    Dashboard
                                </a>
                            </li>
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->

                <!--begin::Toolbar-->
                <div class="d-flex align-items-center"></div>
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container m-5 row">
                <div class="card col-4" style="height: fit-content;">
                    <div class="card-body">
                        <a href="<?php echo $host?>/admin/teacher/index.php" style="color: black;">
                            <b>Teachers</b>
                        </a>
                    </div>
                </div>
                <div class="card col-4" style="height: fit-content;">
                    <div class="card-body">
                        <a href="<?php echo $host?>/admin/student/index.php" style="color: black;">
                            <b>Students</b>
                        </a>
                    </div>
                </div>
                <div class="card col-4" style="height: fit-content;">
                    <div class="card-body">
                        <a href="<?php echo $host?>/admin/course/index.php" style="color: black;">
                            <b>Courses</b>
                        </a>
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
<?php require '../layout/end_app.php';?>

