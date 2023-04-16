<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/category.php';

$cat = new Category();
$allCat = $cat->AllCategory($cat_name);

?>

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-header">Category List</h4>


                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Category Name</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if ($allCat) {
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($allCat)) { ?>

                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $row['cat_name']; ?></td>
                                                <td>
                                                    <a href="catEdit.php?editId=<?php echo base64_encode($row['cat_id']);?>" class="btn btn-success btn-primary">Edit</a>
                                                    <a href="" class="btn btn-success btn-danger">Delete</a>

                                                </td>

                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div>
    </div>
</div>





<?php
include 'inc/footer.php';
?>