<?php require '../layout/app.php';?>

<?php
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'teacher') {
    $url= $host.'/teacher/login.php';
    echo '<script>location.replace("'.$url.'");</script>';
}

$query = "SELECT * FROM courses WHERE teacher_id = ".$_SESSION["user_id"]." ORDER BY created_at DESC ;";
$result = mysqli_query($connection, $query);
$courses = array();
while ($row = mysqli_fetch_assoc($result)) {
    $courses[] = $row;
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
                            <a href="<?php echo $host.'/teacher';?>" class="text-muted">
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
    <div class="d-flex flex-column-fluid row">
        <!--begin::Container-->
        <div class=" container m-5 col-8 row">
            <?php foreach($courses as $course){
                echo '<div class="card col-6" style="height: fit-content;">
                <div class="card-body">
                    <a href="'.$host.'/teacher/grade.php?id='.$course['course_number'].'">
                        <div>'.$course['name'].'</div>
                        <div>'.$course['course_number'].'</div>
                    </a>
                </div>
            </div>';
            }?>

        </div>
        <div class="col-4"></div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<?php require '../layout/end_app.php';?>

