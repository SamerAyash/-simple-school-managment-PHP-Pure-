<?php require '../layout/app.php';?>
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
                            Add grade
                        </h5>
                        <!--end::Page Title-->

                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="{{route('teacher.home')}}" class="text-muted">
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
        <b class="m-5"><?php echo $_GET['id']?></b>
        <!--end::Subheader-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->

            <div class=" container m-5 row">
                <div>
                    <form method="post" action="">
                        <?php
                        if (!isset($_SESSION['csrf_token'])) {
                            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                        }
                        ?>
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Student:</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="student_id" required>

                                <option value="$student['id']">student 1</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Grade:</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Grade" name="grade" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
<?php require '../layout/end_app.php';?>

