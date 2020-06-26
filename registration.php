<?php   

    require 'models/UserRegistration.php';
    require_once 'config/config.init.php';

    if(isset($_SESSION['user_arr'])){ header("Location: index"); exit();}

    $message=false;
    $alertColor="alert-warning";

    $name="";
    $phoneNumber="";

    if(isset($_POST['reg_btn'])){

        $name = trim($_POST['name']);
        $phoneNumber = trim($_POST['phone_number']);
        $password = trim($_POST['password']);
        $retypedPassword = trim($_POST['retyped_password']);

        if(empty($name) || empty($phoneNumber) || empty($password) || empty($retypedPassword)){
            $message="Invalid/Empty fields found!";
        }
        else{
            if($password!=$retypedPassword){
                $message="Password did not match!";
            }
            else{
                $joinedDate = date("Y-m-d");
                
                $newAccountObj = new UserRegistration($name, $phoneNumber, $password, $joinedDate);

                $accountCreationStatus = $newAccountObj->createUser();

                if($accountCreationStatus->affected_rows==0){
                    $message="Could not create account, try again!";
                    $alertColor="alert-danger";
                }
                else if($accountCreationStatus->affected_rows==1){
                    $message=$name.", your account has been created.<br>Login with your phone number and password";
                    $alertColor="alert-success";
                    $name = "";
                    $phoneNumber = "";
                }
                else{
                    $error = strpos(strtolower($accountCreationStatus->error), "phone_number");
                    
                    if(is_null($error)){$message="Fatal error occured!. try again later.";}
                    else{$message="The phone number is already registered!";}

                    $alertColor="alert-danger";
                }
            }
        }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration | Online Residential</title>
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
                        <h6 class="text-muted font-weight-bold p-2 text-center">Create An Account</h6>
                    </div>
                    <div class="card-body px-5">
                        <form action="" method="post">
                        <div class="form-group mb-3">
                                <label class="text-muted small">Name</label>
                                <input class="form-control input-sm" type="text" name="name" minlength="3" maxlength="60" value="<?=$name;?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="text-muted small">Phone number</label>
                                <input class="form-control" type="tel" name="phone_number" pattern="[0-9]*" minlength="5" value="<?=$phoneNumber;?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="text-muted small">Password</label>
                                <input class="form-control" type="password" name="password" minlength="6" required>
                            </div>
                            <div class="form-group mb-4">
                                <label class="text-muted small">Re-type password</label>
                                <input class="form-control" type="password" name="retyped_password" minlength="6" required>
                            </div>
                            <div class="form-group mb-5">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="terms_checkbox" class="custom-control-input" id="customControlAutosizing">
                                    <label class="custom-control-label text-muted small d-block" for="customControlAutosizing">I've read the terms and conditions.<a href=""> Terms</a></label>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <button class="btn btn-success w-100" type="submit" name="reg_btn">Create&ensp;<i class="fas fa-user-plus"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include "includes/footer.php"; ?>
    
<?php include "includes/common-scripts.php"; ?>
