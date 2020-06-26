<?php
    require 'config/config.init.php';
    include 'models/AdOperations.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ad information update | Online Residential</title>

    <?php include "includes/common-css.php"; ?>

</head>
<body>

<?php 
    include "includes/header.php"; 
    include "includes/mobile-search-sidebar.php"; 
?>

    <div class="ad-upload-form-wrapper">
        <div class="card">
            <div class="card-header">
                <h6 class="text-muted font-weight-bold p-2 text-center">Update Your Ad Information</h6>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-row p-2">
                        <div class="form-group col-lg-12">
                            <label class="text-muted small">Title</label>
                            <input class="form-control" type="text" name="" id="">
                            <small class="form-text text-muted">Title should not have more than 150 characters</small>
                        </div>
                        <div class="form-group col-md-5 col-sm-12">
                            <label class="text-muted small">Price</label>
                            <input class="form-control" type="number" name="" id="" min="500" max="300000">
                        </div>
                        <div class="form-group col-md-7 col-sm-12">
                            <label class="text-muted small">Update cover picture</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" accept='.jpg,.jpeg' multiple>
                                <label class="custom-file-label">Image...</label>
                                <small class="form-text text-muted">Supports: jpg and jpeg</small>
                            </div>
                        </div>
                        <div class="form-group col-lg-12 mb-4">
                            <label class="text-muted small">Brief description</label>
                            <textarea class="form-control" name="" id="" rows="5"></textarea>
                            <small class="form-text text-muted">Description should not have more than 600 characters</small>
                        </div>
                        <div class="form-group mb-4 col-md-2 offset-md-10 col-sm-12">
                            <button class="btn btn-info w-100" type="submit">Update&ensp;<i class="fas fa-sync-alt"></i></button>
                        </div>
                    </div>
                </form>
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

</body>
</html>
