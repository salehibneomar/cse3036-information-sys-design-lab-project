<?php
    require_once 'config/config.init.php';
    include_once 'models/UserProfileOperations.php';

    if(!(isset($_SESSION['user_arr']))){ header("Location: logout"); exit();}

    $message=false;
    $alertColor="alert-warning";

    if(isset($_POST['update_btn'])){

        $id=$_SESSION['user_arr']['user_id'];
        $name=strip_tags(trim($_POST['name']));
        $phoneNumber=strip_tags(trim($_POST['phone_number']));
        $email=strip_tags(trim($_POST['email']));

        
        $imageName = $_FILES['image']['name'];
        $imgTempName =$_FILES['image']['tmp_name'];
        $imageFileSize =$_FILES['image']['size'];

        $profileImageDir = $_SESSION['user_arr']['profile_image_dir'];

        if(empty($name) || empty($phoneNumber)){
            $message="Name and Phone cannot be empty!";
        }
        else{
            if($imageFileSize>0){
                $profileImageDir="profile_pic/".$imageName;
            }

            $accountUpdateStatus=UserProfileOperations::updateUserById($id, $name, $phoneNumber, $email, $profileImageDir);

            if($accountUpdateStatus->affected_rows==1){
                $_SESSION['user_arr']['name']=$name;
                $_SESSION['user_arr']['phone_number']=$phoneNumber;
                $_SESSION['user_arr']['email']=$email;
                $_SESSION['user_arr']['profile_image_dir']=$profileImageDir;
                
                $_SESSION['message']="Your account has been updated!";

                move_uploaded_file($imgTempName, $profileImageDir);
                
                sleep(1);
                header("Location: user-profile");
            }
            else if($accountUpdateStatus->affected_rows==0){
                $message="No update!";
                $alertColor="alert-info";
            }
            else{
                $message="Error occured!";
                $alertColor="alert-danger";
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit profile | Online Residential</title>
    <?php include "includes/common-css.php"; ?>
</head>
<body>

<?php 
    include "includes/header.php"; 
    include "includes/mobile-search-sidebar.php"; 
?>

    <div class="container mini-forms">
        <div class="row">
            <div class="col-md-8 col-lg-6 col-sm-12 mx-auto">
            <?php if($message){ ?>
                <div class="alert <?=$alertColor;?> alert-dismissible fade show text-center" role="alert">
                    <strong><?=$message;?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>
                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="text-muted font-weight-bold p-2 text-center">Edit Profile Information</h6>
                    </div>
                    <div class="card-body px-5">
                        <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                                <label class="text-muted small">Name <span class="text-danger">*</span> </label>
                                <input class="form-control input-sm" type="text" name="name" minlength="3" maxlength="60" value="<?=$_SESSION['user_arr']['name'];?>">
                            </div>
                            <div class="form-group mb-3">
                                <label class="text-muted small">Phone number <span class="text-danger">*</span> </label>
                                <input class="form-control" type="tel" name="phone_number" pattern="[0-9]*" minlength="5" value="<?=$_SESSION['user_arr']['phone_number'];?>">
                            </div>
                            <div class="form-group mb-3">
                                <label class="text-muted small">Email</label>
                                <input class="form-control" type="email" name="email" minlength="4" value="<?=$_SESSION['user_arr']['email'];?>">
                            </div>
                            <div class="form-group mb-5">
                                <label class="text-muted small">Update / Upload profile picture</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" accept='.jpg, .jpeg, .png'>
                                    <label class="custom-file-label">Image...</label>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <button class="btn btn-info w-100" name="update_btn">Update&ensp;<i class="fas fa-sync-alt"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include "includes/footer.php"; ?>
    
<?php include "includes/common-scripts.php"; ?>

<script>
    $(document).ready(function(){
        $('.custom-file-input').on('change',function(){
            var fileName = $(this).val().substring($(this).val().lastIndexOf("\\")+1);
            $('.custom-file-label').html(fileName);
        });
    });
</script>
