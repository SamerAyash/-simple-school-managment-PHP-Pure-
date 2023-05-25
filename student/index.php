<?php require '../layout/app.php';?>

<?php
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'student') {
    $url= $host.'/student/login.php';
    echo '<script>location.replace("'.$url.'");</script>';
}

$query = "SELECT * FROM grades JOIN courses ON grades.course_id = courses.course_number WHERE grades.user_id = ".$_SESSION["user_id"]." ORDER BY grades.created_at DESC ;";
$result = mysqli_query($connection, $query);
$grades = array();
while ($row = mysqli_fetch_assoc($result)) {
    $grades[] = $row;
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
                                <a href="<?php echo $host.'/student';?>" class="text-muted">
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
            <div class=" container ">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Course ID</th>
                        <th scope="col">Course Name</th>
                        <th scope="col">Grade</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($grades as $grade){
                            echo '<tr>
                            <td>'.$grade["course_id"].'</td>
                            <td>'.$grade["name"].'</td>
                            <td>'.$grade["grade"].'</td>
                        </tr>';
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
<?php require '../layout/end_app.php';?>

