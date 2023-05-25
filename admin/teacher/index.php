<?php require '../../layout/app.php';?>

<?php
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    $url= $host.'/admin/login.php';
    echo '<script>location.replace("'.$url.'");</script>';
}
$query = "SELECT * FROM teachers ORDER BY created_at DESC";
$result = mysqli_query($connection, $query);
$teachers = array();
while ($row = mysqli_fetch_assoc($result)) {
    $teachers[] = $row;
}
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if ( isset($_POST['_method']) && mysqli_real_escape_string($connection, $_POST['_method']) == 'DELETE'){
    // Escape user inputs for security
    $id = mysqli_real_escape_string($connection, $_POST['id']);
    // Construct the SQL update statement
    $sql = "DELETE FROM teachers WHERE id=$id";
    // Execute the SQL statement
    if (mysqli_query($connection, $sql)) {
    echo '<script>location.replace("'.$host.'/admin/teacher/index.php'.'");</script>';
    }
    else {
    var_dump(mysqli_error($connection));
    exit;}
    }
    }
    ?>
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
                            <a href="<?php echo $host?>/admin/teacher/index.php" class="text-muted">
                                Teachers
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
                        <h3 class="card-label">Teachers</h3>
                    </div>
                    <div class="card-title">
                        <a href="<?php echo $host.'/admin/teacher/form.php'?>" class="btn btn-primary">
                                <span class="svg-icon svg-icon-primary svg-icon-1x">
                                add teacher
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                        <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                                    </g>
                                    </svg></span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!--begin::Example-->
                    <div class="example mb-10">

                        <div class="example-preview">
                            <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!isset($_SESSION["csrf_token"])) {
                                    $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
                                }?>
                                <?php $i=1; foreach($teachers as $teacher){
                                    echo '<tr>
                                    <th scope="row">'.$i.'</th>
                                    <td>
                                        <div class="symbol symbol-150 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                                            <div class="symbol-label" style="background-image: url('.$host."/assets/media/users/100_".$i.".jpg".')">
                                            </div>
                                        </div>

                                    </td>
                                    <td>'.$teacher['name'].'</td>
                                    <td>'.$teacher['email'].'</td>
                                    <td>'.$teacher['phone'].'</td>
                                    <td>
                                        <a href="'.$host."/admin/teacher/form.php?id=".$teacher['id'].'" class="btn btn-outline-primary">
                                                <span class="svg-icon svg-icon-primary svg-icon-1x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Design\Edit.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="18px"
                                                        height="18px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                           fill-rule="evenodd">
                                                            <rect x="0" y="0" width="18" height="18"/>
                                                            <path
                                                                d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                                fill="#000000" fill-rule="nonzero"
                                                                transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                                                            <rect fill="#000000" opacity="0.3" x="5" y="20" width="15"
                                                                  height="2" rx="1"/>
                                                        </g>
                                                    </svg></span>
                                            Edit
                                        </a>
                                        <form method="post" action="'.$host."/admin/teacher/index.php".'" class="btn btn-outline-danger deleteForm'.$teacher['id'].'" onclick="confirmDeleted('.$teacher['id'].')">
                                           
                                            <input type="hidden" name="id" value="'.$teacher['id'].'">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <span class="svg-icon svg-icon-danger svg-icon-1x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-04-19-122603/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>
                                                            <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
                                                        </g>
                                                    </svg></span>
                                            Delete
                                        </form>

                                    </td>
                                </tr>';
                                    $i+=1;
                                } ?>
                                </tbody>
                            </table>
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
<?php
$stack_js='<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function confirmDeleted(id){
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger",
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: "Are you sure ?!",
            text: "You are delete the teacher",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, Delete it",
            cancelButtonText: "No, cancel",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
               
                $(".deleteForm"+id).submit();
            }
        })
    }
</script>';
require '../../layout/end_app.php';
?>