<?php
    require_once 'config/config.init.php';
    if(!(isset($_SESSION['user_arr']))){ header("Location: logout"); exit();}
    include_once 'models/AdOperations.php';

    $message=false;
    $alertColor="alert-warning";

        $title="";
        $city="";
        $location="";
        $price="";
        $residentialType="";
        $direction="";
        $bed="";
        $bath="";
        $floorLevel="";
        $size="";
        $briefDesc="";


    if(isset($_POST['submit'])){
        //Basic Info
        $title=trim($_POST['title']);
        $city=trim($_POST['city']);
        $location=trim($_POST['location']);
        $datePosted=date('Y-m-d');
        $price=trim($_POST['price']);
        $residentialType=$_POST['type'];
        $userId=$_SESSION['user_arr']['user_id'];

        //Features
        $direction=$_POST['direction'];
        $bed=trim($_POST['bed']);
        $bath=trim($_POST['bath']);
        $size=trim($_POST['size']);
        $floorLevel=trim($_POST['floor']);
        $briefDesc=trim($_POST['description']);

        //Images
        $imageArr=$_FILES['ad_images']['name'];
        $imageTempNameArr=$_FILES['ad_images']['tmp_name'];
        $firstImageSize=$_FILES['ad_images']['size'][0];

        if(empty($title) || empty($city) || empty($location) || empty($price) || empty($residentialType) ||
           empty($direction) || empty($bed) || empty($bath) || empty($floorLevel) || empty($size) || 
           empty($briefDesc) || $firstImageSize==0){
            $message="Invalid/Empty fields found!";
        }
        else if(count($imageArr)>5){
            $message="You cannot add more than 5 pictures!";
        }
        else{
            $featureInfo=new AdFeature($direction, $bed, $bath, $size, $floorLevel, $briefDesc);
            $imageList=array();
            for($i=0; $i<count($imageArr); ++$i){
                $imageDir="ad_img/".$imageArr[$i];
                if($i==0){
                    array_push($imageList, new AdImage($imageDir, $datePosted, 1));
                }
                else{
                    array_push($imageList, new AdImage($imageDir, $datePosted, 0));
                }
            }

            $adObj = new AdPopo($title, $city, $location, $datePosted, $price, $residentialType, $featureInfo, $imageList);
            $ad=json_decode(json_encode($adObj), true);

            //print_r($ad);

            $adCreationStatus=AdOperations::createAd($ad, $userId);
            
            if($adCreationStatus==1){
                $title="";
                $city="";
                $location="";
                $price="";
                $residentialType="";
                $direction="";
                $bed="";
                $bath="";
                $floorLevel="";
                $size="";
                $briefDesc="";

                for($i=0; $i<count($imageArr); ++$i){
                    $imageDir="ad_img/".$imageArr[$i];
                    $imageTempName=$imageTempNameArr[$i];
                    move_uploaded_file($imageTempName,$imageDir);
                    usleep(50000);
                }

                $message="Your Ad has been created successfully!";
                $alertColor="alert-success";
            }
            else{
                $message="Error occured";
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
    <title>Ad upload | Online Residential</title>

    <?php include "includes/common-css.php"; ?>

</head>
<body>

<?php 
    include "includes/header.php"; 
    include "includes/mobile-search-sidebar.php"; 
?>

    <div class="ad-upload-form-wrapper">
    <?php if($message){ ?>
        <div class="alert <?=$alertColor;?> alert-dismissible fade show text-center" role="alert">
            <strong><?=$message;?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php }$message=false;?>
        <div class="card">
            <div class="card-header">
                <h6 class="text-muted font-weight-bold p-2 text-center">Ad Information Form</h6>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-row p-2">
                        <div class="form-group col-lg-12">
                            <label class="text-muted small">Title <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="title" minlength="5" maxlength="240" value="<?=$title;?>" required>
                            <small class="form-text text-muted">Title should not have more than 240 characters</small>
                        </div>
                        <div class="form-group col-md-2 col-sm-12">
                            <label class="text-muted small">City <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="city" minlength="3" maxlength="40" value="<?=$city;?>" required>
                        </div>
                        <div class="form-group col-md-10 col-sm-12">
                            <label class="text-muted small">Location <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="location" minlength="10" maxlength="200" value="<?=$location;?>" required>
                        </div>
                        <div class="form-group col-md-5 col-sm-12">
                            <label class="text-muted small">Price <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="price" min="500" max="999999" value="<?=$price;?>" required>
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label class="text-muted small">Residential type <span class="text-danger">*</span></label>
                            <select name="type" class="form-control">
                                <option value="">--Select--</option>
                                <option value="Family">Family</option>
                                <option value="Mess">Mess</option>
                                <option value="Hostel">Hostel</option>
                                <option value="Female Hostel">Female Hostel</option>
                                <option value="Sublet">Sublet</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3 col-sm-12">
                            <label class="text-muted small">Direction <span class="text-danger">*</span></label>
                            <select name="direction" class="form-control">
                                <option value="">--Select--</option>
                                <option value="North">North</option>
                                <option value="South">South</option>
                                <option value="East">East</option>
                                <option value="West">West</option>
                                <option value="Mixed">Mixed</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3 col-sm-12">
                            <label class="text-muted small">Bed <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="bed" min="1" max="999" value="<?=$bed;?>" required>
                        </div>
                        <div class="form-group col-md-3 col-sm-12">
                            <label class="text-muted small">Bath <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="bath" min="1" max="99" value="<?=$bath;?>" required>
                        </div>
                        <div class="form-group col-md-2 col-sm-12">
                            <label class="text-muted small">Floor level <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="floor" min="1" max="999" value="<?=$floorLevel;?>" required>
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label class="text-muted small">Size (Sq Ft) <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="size" min="1.0" step="0.001" max="99999999" value="<?=$size;?>" requied>
                        </div>
                        <div class="form-group col-lg-12">
                            <label class="text-muted small">Upload pictures <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="ad_images[]" accept='.jpg,.jpeg' multiple>
                                <label class="custom-file-label">Image...</label>
                                <small class="form-text text-muted">Max: 5pics | Supports: jpg and jpeg | First image will be used as cover image</small>
                            </div>
                        </div>
                        <div class="form-group col-lg-12 mb-4">
                            <label class="text-muted small">Brief description <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="description" rows="5"  minlength="15" maxlength="600" required><?=$briefDesc;?></textarea>
                            <small class="form-text text-muted">Description should not have more than 1000 characters</small>
                        </div>
                        <div class="form-group mb-4 col-md-2 offset-md-10 col-sm-12">
                            <button class="btn btn-success w-100" type="submit" name="submit" >Submit&ensp;<i class="fas fa-check-circle"></i></button>
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


</body>
</html>

<?php ob_flush(); ?>
