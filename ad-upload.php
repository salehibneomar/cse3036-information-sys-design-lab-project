<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ad upload | Online Residential</title>

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
                <h6 class="text-muted font-weight-bold p-2 text-center">Ad Information Form</h6>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-row p-2">
                        <div class="form-group col-lg-12">
                            <label class="text-muted small">Title <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="" id="">
                            <small class="form-text text-muted">Title should not have more than 150 characters</small>
                        </div>
                        <div class="form-group col-md-2 col-sm-12">
                            <label class="text-muted small">City <span class="text-danger">*</span></label>
                            <select name="" id="" class="form-control">
                                <option value="1">Dhaka</option>
                                <option value="2">Barisal</option>
                                <option value="3">Chittagong</option>
                                <option value="4">Khulna </option>
                                <option value="5">Mymensingh </option>
                                <option value="6">Rajshahi</option>
                                <option value="7">Sylhet</option>
                                <option value="8">Rangpur</option>
                            </select>
                        </div>
                        <div class="form-group col-md-10 col-sm-12">
                            <label class="text-muted small">Location <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="" id="">
                        </div>
                        <div class="form-group col-md-5 col-sm-12">
                            <label class="text-muted small">Price <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="" id="" min="500" max="300000">
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label class="text-muted small">Residential type <span class="text-danger">*</span></label>
                            <select name="" id="" class="form-control">
                                <option value="1">Family</option>
                                <option value="2">Mess</option>
                                <option value="3">Hostel</option>
                                <option value="4">Female Hostel</option>
                                <option value="5">Sublet</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3 col-sm-12">
                            <label class="text-muted small">Direction <span class="text-danger">*</span></label>
                            <select name="" id="" class="form-control">
                                <option value="">Choose...</option>
                                <option value="1">North</option>
                                <option value="2">South</option>
                                <option value="3">East</option>
                                <option value="4">West</option>
                                <option value="5">Mixed</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3 col-sm-12">
                            <label class="text-muted small">Bed <span class="text-danger">*</span></label>
                            <select name="" id="" class="form-control">
                                <option value="">Choose...</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">Above 5</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3 col-sm-12">
                            <label class="text-muted small">Bath <span class="text-danger">*</span></label>
                            <select name="" id="" class="form-control">
                                <option value="">Choose...</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">Above 3</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2 col-sm-12">
                            <label class="text-muted small">Floor level <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="" id="" min="1" max="60">
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label class="text-muted small">Size (Sq Ft) <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="" id="" min="100.0" step="0.5">
                        </div>
                        <div class="form-group col-lg-12">
                            <label class="text-muted small">Upload pictures <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" accept='.jpg,.jpeg' multiple>
                                <label class="custom-file-label">Image...</label>
                                <small class="form-text text-muted">Max: 5pics | Supports: jpg and jpeg | First image will be used as cover image</small>
                            </div>
                        </div>
                        <div class="form-group col-lg-12 mb-4">
                            <label class="text-muted small">Brief description <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="" id="" rows="5"></textarea>
                            <small class="form-text text-muted">Description should not have more than 600 characters</small>
                        </div>
                        <div class="form-group mb-4 col-md-2 offset-md-10 col-sm-12">
                            <button class="btn btn-success w-100" type="submit">Submit&ensp;<i class="fas fa-check-circle"></i></button>
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
            var totalFiles = $(this).get(0).files.length;
            var msg=""
            if(totalFiles==1){
                msg=totalFiles+" picture selected.";
            }
            else if(totalFiles<6){
                msg=totalFiles+" pictures selected.";
            }
            else{
                msg="More than 5 picture selected, won't be uploaded."
            }

            $('.custom-file-label').html(msg);
        });
    });
</script>
