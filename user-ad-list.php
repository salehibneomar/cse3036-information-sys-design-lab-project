<?php
    require 'config/config.init.php';
    include 'models/AdOperations.php';

    if(!(isset($_SESSION['user_arr']))){ header("Location: logout"); exit();}

    $getAdListByUserId=AdOperations::getAdListByUserId($_SESSION['user_arr']['user_id']);
    $adStatus=array("Processing","Live");
    $adStatusColor=array("badge-info", "badge-success");
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
    <?php if(isset($_SESSION['message'])){ ?>
        <div class="alert <?=$_SESSION['alertColor'];?> alert-dismissible fade show text-center" role="alert">
            <strong><?=$_SESSION['message'];?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
     <?php } unset($_SESSION['message']); 
             unset($_SESSION['alertColor']); 
    ?>
        <div class="card">
            <div class="card-header bg-light">
                <h6 class="text-muted font-weight-bold p-2 text-center"><?=$getAdListByUserId->num_rows;?>, records found.</h6>
            </div>
            <?php if($getAdListByUserId->num_rows!=0){ ?>
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
                    <?php while($result=$getAdListByUserId->fetch_assoc()){ ?>
                        <tr>
                            <td><img src="<?=$result['image_dir'];?>"  width="80" height="60"></td>
                            <td class="d-line-block text-truncate"><?=$result['title'];?></td>
                            <td><span class="badge badge-secondary p-2"><?=$result['date_posted'];?></span></td>
                            <td><span class="badge <?=$adStatusColor[$result['ad_status']];?> p-2"><?=$adStatus[$result['ad_status']];?></span></td>
                            <td>
                                <a href="view-add-details?ad_id=<?=$result['ad_id'];?>" class="btn btn-sm btn-success"><i class="far fa-eye"></i></a>
                                <a href="ad-information-update?ad_id=<?=$result['ad_id'];?>" class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                                <a href="delete-ad?ad_id=<?=$result['ad_id'];?>" class="btn btn-sm btn-danger delete_btn"><i class="far fa-trash-alt"></i></a>
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

        $('.delete_btn').on('click', function(e){
        e.preventDefault();
            let link=$(this).attr('href');
            Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Okay'
            }).then((result) => {
                if (result.value){
                    $(location).attr('href',link);
                }
            });
        });
    });
</script>


</body>
</html>
