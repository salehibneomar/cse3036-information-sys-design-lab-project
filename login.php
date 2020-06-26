<?php   

    require_once 'config/config.init.php';
    require 'models/UserLogin.php';

    if(isset($_SESSION['user_arr'])){ header("Location: index"); exit();}

    $message=false;
    $alertColor="alert-warning";
    $phoneNumber="";

    if(isset($_POST['login_btn'])){
        $phoneNumber=trim($_POST['phone_number']);
        $password=trim($_POST['password']);

        if(empty($phoneNumber) || empty($password)){
            $message="Invalid/Empty fileds found!";
        }
        else{
            $userLoginObj = new UserLogin($phoneNumber, $password);
            $user = $userLoginObj->getUser();

            if(is_null($user)){
                $message="Invalid login information!";
                $alertColor="alert-danger";
            }
            else{
                $_SESSION['user_arr']=$user->fetch_assoc();
                header("Location: index");
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Online Residential</title>
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
                        <h6 class="text-muted font-weight-bold p-2 text-center">Login To Your Account</h6>
                    </div>
                    <div class="card-body px-5">
                        <form action="" method="post">
                            <div class="form-group mb-3">
                                <label class="text-muted small">Phone number</label>
                                <input class="form-control" type="tel" pattern="[0-9]*" name="phone_number" value="<?=$phoneNumber;?>" required>
                            </div>
                            <div class="form-group mb-4">
                                <label class="text-muted small">Password</label>
                                <input class="form-control" type="password" name="password" required>
                            </div>
                            <div class="form-group mb-5">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                            <label class="custom-control-label text-muted" for="customControlAutosizing">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="col-5 text-right">
                                        <a href="" class="small">Forgot password?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success w-100" type="submit" name="login_btn" >Login&ensp;<i class="fas fa-sign-in-alt"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include "includes/footer.php"; ?>
    
<?php include "includes/common-scripts.php"; ?>

</body>
</html>
