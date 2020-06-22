<?php
    require_once 'config/config.init.php';
    if(!(isset($_SESSION['user_arr']))){ header("Location: logout"); exit();}
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
                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="text-muted font-weight-bold p-2 text-center">Edit Profile Information</h6>
                    </div>
                    <div class="card-body px-5">
                        <form action="" method="post">
                        <div class="form-group mb-3">
                                <label class="text-muted small">Name</label>
                                <input class="form-control input-sm" type="text" name="" value="<?=$_SESSION['user_arr']['name'];?>">
                            </div>
                            <div class="form-group mb-3">
                                <label class="text-muted small">Phone number</label>
                                <input class="form-control" type="tel" name="" value="<?=$_SESSION['user_arr']['phone_number'];?>">
                            </div>
                            <div class="form-group mb-3">
                                <label class="text-muted small">Email</label>
                                <input class="form-control" type="email" name="" value="<?=$_SESSION['user_arr']['email'];?>">
                            </div>
                            <div class="form-group mb-5">
                                <label class="text-muted small">Update / Upload profile picture</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" accept='.jpg,.jpeg'>
                                    <label class="custom-file-label">Image...</label>
                                </div>
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

<script>
    $(document).ready(function(){
        $('.custom-file-input').on('change',function(){
            var fileName = $(this).val().substring($(this).val().lastIndexOf("\\")+1);
            $('.custom-file-label').html(fileName);
        });
    });
</script>
