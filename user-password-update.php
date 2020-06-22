<?php
    require_once 'config/config.init.php';
    if(!(isset($_SESSION['user_arr']))){ header("Location: logout"); exit();}
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
                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="text-muted font-weight-bold p-2 text-center">Edit Password</h6>
                    </div>
                    <div class="card-body px-5">
                        <form action="" method="post">
                            <div class="form-group mb-3">
                                <label class="text-muted small">Previous password</label>
                                <input class="form-control" type="password" name="" id="">
                            </div>
                            <div class="form-group mb-3">
                                <label class="text-muted small">New password</label>
                                <input class="form-control" type="password" name="" id="">
                            </div>
                            <div class="form-group mb-5">
                                <label class="text-muted small">Re-type password</label>
                                <input class="form-control" type="password" name="" id="">
                            </div>
                            <div class="form-group mb-4">
                                <button class="btn btn-info w-100">Update&ensp;<i class="fas fa-sync-alt"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include "includes/footer.php"; ?>
    
<?php include "includes/common-scripts.php"; ?>
