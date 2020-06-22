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
                <h6 class="text-muted font-weight-bold p-2 text-center">All Ads</h6>
            </div>
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
                        <tr>
                            <td><img src="img/kk.jfif" alt="" width="80" height="60"></td>
                            <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</td>
                            <td><span class="badge badge-secondary p-2">5/1/2020</span></td>
                            <td><span class="badge badge-info p-2">Posted</span></td>
                            <td>
                                <a href="view-add-details.php" class="btn btn-sm btn-success"><i class="far fa-eye"></i></a>
                                <a href="ad-information-update.php" class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                                <a href="" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="img/kk.jfif" alt="" width="80" height="60"></td>
                            <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</td>
                            <td><span class="badge badge-secondary p-2">5/1/2020</span></td>
                            <td><span class="badge badge-info p-2">Posted</span></td>
                            <td>
                                <a href="view-add-details.php" class="btn btn-sm btn-success"><i class="far fa-eye"></i></a>
                                <a href="ad-information-update.php" class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                                <a href="" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="img/kk.jfif" alt="" width="80" height="60"></td>
                            <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</td>
                            <td><span class="badge badge-secondary p-2">5/1/2020</span></td>
                            <td><span class="badge badge-info p-2">Posted</span></td>
                            <td>
                                <a href="view-add-details.php" class="btn btn-sm btn-success"><i class="far fa-eye"></i></a>
                                <a href="ad-information-update.php" class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                                <a href="" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
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
