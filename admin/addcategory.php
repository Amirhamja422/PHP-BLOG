<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/category.php';

$cat = new Category();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $cat_name = $_POST['cat_name'];
    $catAdd = $cat->AddCategory($cat_name);
}

?>



<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
<div class="row">
    <div class="col-xl-6">


        <span>
        <?php
        if(isset($catAdd)){?>
        <div class="alert alert-primary" role="alert">
            <?php echo $catAdd;?>
        </div>
        <?php } ?>
        </span>


        <div class="card shadow">
        <h4 class="card-header">Category Add Form</h4>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="cat_name" id="cate _name" placeholder="Enter Category Name" />
                    </div> 
                    <div>
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
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