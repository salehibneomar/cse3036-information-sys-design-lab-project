<?php
    require_once 'config/config.init.php';
    include_once 'models/UserProfileOperations.php';

    if(!(isset($_SESSION['user_arr']))){ header("Location: logout"); exit();}

    $message=false;
    $alertColor="alert-warning";

    if(isset($_POST['update_btn'])){
        $id=$_SESSION['user_arr']['user_id'];
        $oldPassword=trim($_POST['old_password']);
        $newPassword=trim($_POST['new_password']);
        $retypedNewPassword=trim($_POST['retyped_new_password']);

        if(empty($oldPassword) || empty($newPassword) || empty($retypedNewPassword)){
            $message="Empty/Invalid fields found!";
        }
        else if($newPassword!=$retypedNewPassword){
            $message="New password didn't match with the re-typed password!";
        }
        else{
            $passwordChangeStatus=UserProfileOperations::updateUserPasswordById($id, $oldPassword, $newPassword);
            sleep(1);
            if($passwordChangeStatus==2){
                $message="Wrong old password!";
                $alertColor="alert-danger";
            }
            else if($passwordChangeStatus==0){
                $message="Old and new password are same!";
            }
            else if($passwordChangeStatus==1){
                $message="Password updated!";
                $alertColor="alert-success";
            }
            else {
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
    <title>Update passowrd | Online Residential</title>
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
                        <h6 class="text-muted font-weight-bold p-2 text-center">Edit Password</h6>
                    </div>
                    <div class="card-body px-5">
                        <form action="" method="post">
                            <div class="form-group mb-3">
                                <label class="text-muted small">Previous password</label>
                                <input class="form-control" type="password" name="old_password" >
                            </div>
                            <div class="form-group mb-3">
                                <label class="text-muted small">New password</label>
                                <input class="form-control" type="password" name="new_password">
                            </div>
                            <div class="form-group mb-5">
                                <label class="text-muted small">Re-type password</label>
                                <input class="form-control" type="password" name="retyped_new_password" >
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
