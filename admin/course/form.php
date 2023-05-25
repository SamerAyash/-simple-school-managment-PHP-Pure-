<?php require '../../layout/app.php';?>
<?php
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    $url= $host.'/admin/login.php';
    echo '<script>location.replace("'.$url.'");</script>';
}
$is_edit= isset($_GET['id']) && $_GET['id'];
$course= null;

$query1 = "SELECT * FROM teachers ORDER BY created_at DESC";
$result1 = mysqli_query($connection, $query1);
$teachers = array();

while ($row = mysqli_fetch_assoc($result1)) {
    $teachers[] = $row;
}
if ($is_edit){
    $query = "SELECT * FROM courses WHERE id = ".$_GET['id'];
    $result = mysqli_query($connection, $query);
    $course = mysqli_fetch_assoc($result);
}

?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if ( isset($_POST['_method']) && mysqli_real_escape_string($connection, $_POST['_method']) == 'PUT'){
        // Escape user inputs for security
        $id = mysqli_real_escape_string($connection, $_POST['id']);
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $number = mysqli_real_escape_string($connection, $_POST['number']);
        // Construct the SQL update statement
        $sql = "UPDATE courses SET name='$name', number='$number' WHERE id=$id";
        // Execute the SQL statement
        if (mysqli_query($connection, $sql)) {
            echo '<script>location.replace("'.$host.'/admin/course/index.php'.'");</script>';
        } else {
            var_dump(mysqli_error($connection));
            exit;
        }
    }
    else{
        // Escape user inputs for security
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $number = mysqli_real_escape_string($connection, $_POST['number']);
        $teacher_id = mysqli_real_escape_string($connection, $_POST['teacher_id']);
        // Prepare SQL statement
        $sql = "INSERT INTO courses (name, number) VALUES (?, ?,?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sss", $name, $number,$teacher_id);
        $stmt->execute();
        // Check for errors
        if ($stmt->error) {
            echo "Error: " . $stmt->error;
        } else {
            echo '<script>location.replace("'.$host.'/admin/course/index.php'.'");</script>';
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
                            Courses
                        </h5>
                        <!--end::Page Title-->

                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="<?php $host.'/admin/course'?>" class="text-muted">
                                    Courses
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#" class="text-muted">
                                    <?php echo $is_edit ? 'Edit course' : 'Create course'; ?>
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
                            <h3 class="card-label"><?php echo $is_edit? 'Edit course' : 'Create new course'; ?></h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin::Example-->
                        <div class="example mb-10">
                            <div class="example-preview">
                                <form method="post" action="<?php echo $is_edit ? $host.'/admin/course/form.php?id='.$_GET['id'] : $host.'/admin/course/form.php';?>" enctype="multipart/form-data">
                                    <?php
                                        if (!isset($_SESSION['csrf_token'])) {
                                            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                                        }
                                    ?>
                                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                    <?php echo $is_edit? '<input type="hidden" name="_method" value="PUT"><input type="hidden" name="id" value="'.$_GET['id'].'">': ''; ?>

                                    <div class="form-group row">
                                        <label  class="col-2 col-form-label">Name </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" value="<?php echo $is_edit? $course['name'] : null ?>" name="name"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-2 col-form-label">Number</label>
                                        <div class="col-10">
                                            <input class="form-control" type="number" value="<?php echo $is_edit? $course['number'] : null ?>" name="number"/>
                                        </div>
                                    </div>
                                    <div class="input-group row">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">Teacher</label>
                                        </div>
                                        <select class="custom-select" id="inputGroupSelect01" name="teacher_id">
                                            <option disabled>Choose...</option>
                                            <?php
                                            foreach($teachers as $teacher){
                                                $status=$is_edit? ($course['teacher_id'] == $teacher['id']? 'selected' : null ): null ;
                                                echo '<option value="'.$teacher['id'].'" '.$status.'> '.$teacher['name'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="card-footer align-items-end">
                                        <?php echo $is_edit?
                                            '<button type="submit" class="btn btn-success mr-2">Update</button>'
                                            :
                                            '<button type="submit" class="btn btn-success mr-2">Store</button>';
                                        ?>
                                        <a href="<?php echo $host.'/admin/course/index.php'; ?>"  class="btn btn-secondary">Cancel</a>
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