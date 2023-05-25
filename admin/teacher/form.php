<?php require '../../layout/app.php';?>
<?php
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    $url= $host.'/admin/login.php';
    echo '<script>location.replace("'.$url.'");</script>';
}
$is_edit= isset($_GET['id']) && $_GET['id'];
$teacher= null;
if ($is_edit){
    $query = "SELECT * FROM teachers WHERE id = ".$_GET['id'];
    $result = mysqli_query($connection, $query);
    $teacher = mysqli_fetch_assoc($result);
}

?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if ( isset($_POST['_method']) && mysqli_real_escape_string($connection, $_POST['_method']) == 'PUT'){
        // Escape user inputs for security
        $id = mysqli_real_escape_string($connection, $_POST['id']);
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $phone = mysqli_real_escape_string($connection, $_POST['phone']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        // Construct the SQL update statement
        $password_statment= isset($password) && $password ? ", password='$password'" : null;
        $sql = "UPDATE teachers SET name='$name', email='$email', phone='$phone'".$password_statment." WHERE id=$id";
        // Execute the SQL statement
        if (mysqli_query($connection, $sql)) {
            echo '<script>location.replace("'.$host.'/admin/teacher/index.php'.'");</script>';
        } else {
            var_dump(mysqli_error($connection));
            exit;
        }
    }
    else{
        // Escape user inputs for security
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $phone = mysqli_real_escape_string($connection, $_POST['phone']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
// Prepare SQL statement
        $sql = "INSERT INTO teachers (name, email, password, phone) VALUES (?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $password, $phone);
        $stmt->execute();
// Check for errors
        if ($stmt->error) {
            echo "Error: " . $stmt->error;
        } else {
            echo '<script>location.replace("'.$host.'/admin/teacher/index.php'.'");</script>';
        }
// Close statement and connection
        $stmt->close();
    }

}
?>
<script>
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];

        if(file){
            var reader = new FileReader();

            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
    }
</script>
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
                            Teachers
                        </h5>
                        <!--end::Page Title-->

                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="<?php $host.'/admin/teacher'?>" class="text-muted">
                                    Teachers
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#" class="text-muted">
                                    <?php echo $is_edit ? 'Edit teacher' : 'Create teacher'; ?>
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
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label"><?php echo $is_edit? 'Edit teacher' : 'Create new teacher'; ?></h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin::Example-->
                        <div class="example mb-10">
                            <div class="example-preview">
                                <form method="post" action="<?php echo $is_edit ? $host.'/admin/teacher/form.php?id='.$_GET['id'] : $host.'/admin/teacher/form.php';?>" enctype="multipart/form-data">
                                    <?php
                                        if (!isset($_SESSION['csrf_token'])) {
                                            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                                        }
                                    ?>
                                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                    <?php echo $is_edit? '<input type="hidden" name="_method" value="PUT"><input type="hidden" name="id" value="'.$_GET['id'].'">': ''; ?>
                                    <div class="image-input image-input-outline mb-3" >
                                        <img width="250" id="previewImg" src="<?php echo $host?>/assets/media/users/default.jpg" alt="Placeholder">
                                        <p>
                                            <input type="file" name="image" accept=".jpeg,.jpg,.png,.gif" onchange="previewFile(this);">
                                        </p>
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-2 col-form-label">Name </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" value="<?php echo $is_edit? $teacher['name'] : null ?>" name="name"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-2 col-form-label">Email</label>
                                        <div class="col-10">
                                            <input class="form-control" type="email" value="<?php echo $is_edit? $teacher['email'] : null ?>" name="email"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-2 col-form-label">Phone</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" value="<?php echo $is_edit? $teacher['phone'] : null ?>" name="phone"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-2 col-form-label">Password</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" value="" name="password"/>
                                        </div>
                                    </div>
                                    <div class="card-footer align-items-end">
                                        <?php echo $is_edit?
                                            '<button type="submit" class="btn btn-success mr-2">Update</button>'
                                            :
                                            '<button type="submit" class="btn btn-success mr-2">Store</button>';
                                        ?>
                                        <a href="<?php echo $host.'/admin/teacher/index.php'; ?>"  class="btn btn-secondary">Cancel</a>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!--end::Example-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
<?php require '../../layout/end_app.php';?>