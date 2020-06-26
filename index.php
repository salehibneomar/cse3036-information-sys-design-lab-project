<?php
    require_once 'config/config.init.php';
    require_once 'models/AdOperations.php';
    include_once 'models/SiteStat.php';

    $getAllAds=AdOperations::getAllAds();
    $siteStat=SiteStat::getSiteStat();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Residential</title>
    <?php include "includes/common-css.php"; ?>
</head>
<body>

<?php 
    include "includes/header.php"; 
    include "includes/mobile-search-sidebar.php"; 
?>

    <section class="main-section">
        <div class="main-section-wrapper card">

<?php include "includes/desktop-search-panel.php"; ?>

                <div class="middle-content card">
                    <div class="card-header bg-light mobile-content">
                    <!-- All add title for mobile content, desktop title is in desktop-search-panel.php -->
                        <span class="d-block text-center font-weight-bold"><small><?=$getAllAds->num_rows;?>, Ads found.</small></span>
                    </div>
                    <div class="card-body">
                        <div class="row px-2">
                        <?php while($result=$getAllAds->fetch_assoc()){ ?>
                            <div class="col-lg-4 col-sm-6 mb-4">
                                <div class="card advert-card">
                                    <div class="ad-image-con">
                                        <img src="<?=$result['image_dir'];?>" alt="image" />
                                    </div>
                                    <div class="card-body pb-0">
                                        <?php if($result['acc_status']==3){?>
                                            <span class="badge badge-success"><i class="fas fa-award"></i>&ensp;Prime User</span>
                                        <?php } ?>
                                        <h6><?=$result['title'];?></h6>
                                        <p><i class="fas fa-map-marker-alt text-danger">&ensp;</i><?=$result['city'];?></p>
                                        <p><i class="fas fa-clock text-info"></i>&ensp;<?=$result['date_posted'];?></p>
                                        <p><i class="fas fa-tag text-warning"></i>&ensp;<?=$result['residential_type'];?></p>
                                        <h5 class="text-right"><span class="text-primary">৳</span>&ensp;<?=number_format($result['price']);?>/<small>Mo</small></h5>
                                    </div>
                                    <div class="card-footer mt-0 bg-transparent">
                                        <a href="view-add-details?ad_id=<?=$result['ad_id'];?>" class="btn btn-sm btn-secondary w-100"><i class="fas fa-arrow-right"></i>&ensp; See details</a>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                        </div>

                        <?php include "includes/pagination.php"; ?>

                    </div>

                </div>   
                 
                
        </div>
    </section>

<?php include "includes/footer.php"; ?>
    
<?php include "includes/common-scripts.php"; ?>

</body>
</html>

<?php ob_flush(); ?>