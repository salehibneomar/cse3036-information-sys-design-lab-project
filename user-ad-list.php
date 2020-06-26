<?php
    require_once 'config/config.init.php';
    if(!(isset($_SESSION['user_arr']))){ header("Location: logout"); exit();}
    require_once 'models/AdOperations.php';

    $getAddListByUserId=AdOperations::getAddListByUserId($_SESSION['user_arr']['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ad list | Online Residential</title>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <?php include "includes/common-css.php"; ?>

</head>
<body>

<?php 
    include "includes/header.php"; 
    include "includes/mobile-search-sidebar.php"; 
?>

    <div class="ad-list-wrapper">
        <div class="card">
            <div class="card-header bg-light">
                <h6 class="text-muted font-weight-bold p-2 text-center"><?=$getAddListByUserId->num_rows;?>, records found.</h6>
            </div>
            <?php if($getAddListByUserId->num_rows!=0){ ?>
            <div class="card-body">
                <table class="table table-hover w-100" id="ad-list-table" >
                    <thead>
                        <tr>
                            <th width="10%">Image</th>
                            <th>Title</th>
                            <th width="15%">Date</th>
                            <th width="15%">Status</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($result=$getAddListByUserId->fetch_assoc()){ ?>
                        <tr>
                            <td><img src="<?=$result['image_dir'];?>"  width="80" height="60"></td>
                            <td class="d-line-block text-truncate"><?=$result['title'];?></td>
                            <td><span class="badge badge-secondary p-2"><?=$result['date_posted'];?></span></td>
                            <td><span class="badge badge-info p-2"><?=$result['ad_status'];?></span></td>
                            <td>
                                <a href="view-add-details?ad_id=<?=$result['ad_id'];?>" class="btn btn-sm btn-success"><i class="far fa-eye"></i></a>
                                <a href="ad-information-update?ad_id=<?=$result['ad_id'];?>" class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                                <a href="delete-ad?ad_id=<?=$result['ad_id'];?>" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>

                    <?php } ?>    
                    </tbody>
                </table>
            </div>
            <?php } ?>    
        </div>
    </div>


<?php include "includes/footer.php"; ?>
    
<?php include "includes/common-scripts.php"; ?>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script >
    $(document).ready(function(){
        $('#ad-list-table').DataTable( {
            "paging":   false,
            "info":     false
        });
    });
</script>
