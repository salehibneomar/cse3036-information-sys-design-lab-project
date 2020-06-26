<?php
    require_once 'config/config.init.php';
    require_once 'models/AdOperations.php';

    if(isset($_GET['ad_id'])){
        $adId=strip_tags(trim($_GET['ad_id']));
        if(!empty($adId)){
            $wholeAd=AdOperations::viewAdById($adId);
            $adInformations=$wholeAd[0];
            $adPictures=$wholeAd[1];

            if($adInformations->num_rows!=1){
                header("Location: index");
                exit();
            }

            $adInfoResult=$adInformations->fetch_assoc();
            
        }
        else{
            header("Location: index");
        }
    }
    else{
        header("Location: index");
    }

    $message=false;
    $alertColor="alert-warning";

    if(isset($_POST['report_btn']) && isset($_SESSION['user_arr'])){
        $dateReported=date('Y-m-d');
        $userId=$_SESSION['user_arr']['user_id'];
        $reason=strip_tags(trim($_POST['reason']));

        if(empty($reason)){
            $message="Report cannot be empty!";
        }
        else{
            $adReportObj = new AdReport($reason, $dateReported, $adId, $userId);
            $report = json_decode(json_encode($adReportObj), true);

            $adReportStatus = AdOperations::adReport($report);

            if($adReportStatus==2){
                $message="You cannot report more than once on a same Ad!";
                $alertColor="alert-danger";
            }
            else if($adReportStatus==1){
                $message="Reported successfully, we will look into it!";
                $alertColor="alert-success";
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
    <title>Ad details | <?=substr($adInfoResult['title'],0,15);?>...</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/flexslider.min.css">
    <?php include "includes/common-css.php"; ?>
</head>
<body>

<?php 
    include "includes/header.php"; 
    include "includes/mobile-search-sidebar.php"; 
?>

    <div class="ad-details-card">
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
                <h5 class="card-title p-0 m-3 font-weight-bold"><?=$adInfoResult['title'];?></h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-7 slider-col">
                        <div class="flexslider">
                            <ul class="slides">
                            <?php while($adPicResult=$adPictures->fetch_assoc()){ ?>
                                <li>
                                    <img src="<?=$adPicResult['image_dir'];?>" alt="image" />
                                </li>
                            <?php }?>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-lg-5 information-col">
                        <div class="card">
                        <div class="card-header bg-light">
                            <h6>Information</h6>
                        </div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <i class="fas fa-user text-primary"></i>&emsp;<?=$adInfoResult['name'];?>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-thumbtack text-success"></i>&emsp;<?=$adInfoResult['city'];?>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-map-marker-alt text-info"></i>&emsp;<?=$adInfoResult['location'];?>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-money-bill text-danger"></i>&emsp;<?=number_format($adInfoResult['price']);?>&ensp;Taka/Mo.
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-clock text-secondary"></i>&emsp;<?=$adInfoResult['date_posted'];?>
                                </li>
                                <a class="list-group-item text-dark" href="tel:<?=$adInfoResult['phone_number'];?>">
                                    <i class="fas fa-phone-alt text-success"></i>&emsp;<?=$adInfoResult['phone_number'];?>
                                </a>
                                <a class="list-group-item text-dark" href="mailto:<?=$adInfoResult['email'];?>">
                                    <i class="fas fa-envelope text-primary"></i>&emsp;<?=$adInfoResult['email'];?>
                                </a>
                                <li class="list-group-item">
                                    <i class="fas fa-tag text-warning"></i>&emsp;<?=$adInfoResult['residential_type'];?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row details-last-row">
                    <div class="col-lg-7 information-col">
                        <div class="card">
                            <div class="card-header bg-light mb-3">
                                <h6>Description</h6>
                            </div>
                            <p>
                             <?=$adInfoResult['breif_desc'];?>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-5 information-col">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6>Features</h6>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <i class="fas fa-bed text-info"></i>&emsp;Bed:&ensp;<?=$adInfoResult['bed'];?>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-bath text-success"></i>&emsp;Bath:&ensp;<?=$adInfoResult['bath'];?>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-directions text-danger"></i>&emsp;Direction:&ensp;<?=$adInfoResult['direction'];?>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-layer-group text-warning"></i>&emsp;Floor:&ensp;<?=$adInfoResult['floor_level'];?>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-compress text-primary"></i>&emsp;Size:&ensp;<?=$adInfoResult['size'];?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php if(isset($_SESSION['user_arr'])){ ?>
                <div class="row ad-report-row">
                    <div class="col-lg-5 offset-lg-7 information-col">
                        <div class="card">
                            <div class="card-header">
                                <h6>Any problem with this ad? Report.</h6>
                            </div>
                            <div class="card-body px-0">
                                <form action="" method="post">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-secondary" id="basic-addon1"><i class="fas fa-bug"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="reason" placeholder="Type..." minlength="3" maxlength="200" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="submit" name="report_btn">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>


<?php include "includes/footer.php"; ?>
    
<?php include "includes/common-scripts.php"; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/jquery.flexslider.min.js"></script>
<script>
    $(document).ready(function(){
        $('.flexslider').flexslider({
            animation: "slide",
            startAt: 0,
            slideshow: true,
            slideshowSpeed: 4000,
            pauseOnHover: true
        });
    });
</script>

</body>
</html>
