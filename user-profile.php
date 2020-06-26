<?php
    require_once 'config/config.init.php';
    if(!(isset($_SESSION['user_arr']))){ header("Location: logout"); exit();}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | <?=$_SESSION['user_arr']['name'];?></title>
    <?php include "includes/common-css.php"; ?>
</head>
<body>

<?php 
    include "includes/header.php"; 
    include "includes/mobile-search-sidebar.php"; 
?>

    <div class="profile-wrapper">
        <?php if(isset($_SESSION['message'])){ ?>
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    <strong><?=$_SESSION['message'];?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } unset($_SESSION['message']); ?>
        <div class="card">
            <div class="card-header bg-light"> 
                <img src="<?=$_SESSION['user_arr']['profile_image_dir'];?>" alt="image" class="mx-auto d-block img-thumbnail">
            </div>
            <div class="card-body">
                <table class="table table-sm table-bordered">
                    <tbody>
                        <tr>
                            <td class="w-50 text-left px-3 py-2">Name</td>
                            <td class="w-50 text-right px-3 py-2"><?=$_SESSION['user_arr']['name'];?></td>
                        </tr>
                        <tr>
                            <td class="w-50 text-left px-3 py-2">Date Joined</td>
                            <td class="w-50 text-right px-3 py-2"><?=$_SESSION['user_arr']['joined_date'];?></td>
                        </tr>
                        <tr>
                            <td class="w-50 text-left px-3 py-2">Phone</td>
                            <td class="w-50 text-right px-3 py-2"><?=$_SESSION['user_arr']['phone_number'];?></td>
                        </tr>
                        <tr>
                            <td class="w-50 text-left px-3 py-2">Email</td>
                            <?php if(is_null($_SESSION['user_arr']['email'])){ ?>
                            <td class="w-50 text-right px-3 py-2">N/A</td>
                            <?php } else{ ?>
                            <td class="w-50 text-right px-3 py-2"><?=$_SESSION['user_arr']['email'];?></td>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-light py-4">
                <a href="user-password-update" class="btn btn-sm btn-danger float-left"><i class="fas fa-key"></i>&ensp;Edit password</a>
                <a href="user-profile-update" class="btn btn-sm btn-success float-right">Edit profile&ensp;<i class="fas fa-user-circle"></i></a>
            </div>
        </div>
    </div>

<?php include "includes/footer.php"; ?>

<?php include "includes/common-scripts.php"; ?>

</body>
</html>
