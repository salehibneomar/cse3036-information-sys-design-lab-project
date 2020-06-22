<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ad details | Online Residential</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/flexslider.min.css">
    <?php include "includes/common-css.php"; ?>
</head>
<body>

<?php 
    include "includes/header.php"; 
    include "includes/mobile-search-sidebar.php"; 
?>

    <div class="ad-details-card">
        <div class="card">
            <div class="card-header bg-light">
                <span class="badge badge-success" style="font-size:11pt !important;"><i class="fas fa-check"></i>&ensp;Verified</span>
                <h5 class="card-title p-0 m-3 font-weight-bold">Title</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-7 slider-col">
                        <div class="flexslider">
                            <ul class="slides">
                                <li>
                                    <img src="img/kk.jfif" />
                                </li>
                                <li>
                                    <img src="img/the_witcher_3_wild_hunt_blood_and_wine_toussaint_landscape-wallpaper-3840x2160.jpg" />
                                </li>
                                <li>
                                    <img src="img/kk.jfif" />
                                </li>
                                <li>
                                    <img src="img/the_witcher_3_wild_hunt_blood_and_wine_toussaint_landscape-wallpaper-3840x2160.jpg" />
                                </li>
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
                                    <i class="fas fa-user text-primary"></i>&emsp;Abdul Ahad Khan Pathan Kuddus
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-thumbtack text-success"></i>&emsp;Dhaka
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-map-marker-alt text-info"></i>&emsp;Gulshan Model Town 1212
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-money-bill text-danger"></i>&emsp;15000 Taka/Mo.
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-clock text-secondary"></i>&emsp;4/6/2020
                                </li>
                                <a class="list-group-item text-dark" href="tel:01700000000">
                                    <i class="fas fa-phone-alt text-success"></i>&emsp;01700000000
                                </a>
                                <a class="list-group-item text-dark" href="mailto:dummy.email@gmai.com">
                                    <i class="fas fa-envelope text-primary"></i>&emsp;dummy.email@gmai.com
                                </a>
                                <li class="list-group-item">
                                    <i class="fas fa-tag text-warning"></i>&emsp;Family
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
                                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
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
                                    <i class="fas fa-bed text-info"></i>&emsp;Bed: 5
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-bath text-success"></i>&emsp;Bath: 2
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-directions text-danger"></i>&emsp;Direction: North
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-layer-group text-warning"></i>&emsp;Floor: 4th
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-compress text-primary"></i>&emsp;Size: 2598 sqft.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
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
                                        <input type="text" class="form-control" placeholder="Type...">
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
