<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/post.php';

$post = new post();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $postAdd = $post->AddPost($_POST,$_FILES);
}

?>



<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
<div class="row">
    <div class="col-xl-8">

        <span>
        <?php
        if(isset($postAdd)){?>
        <div class="alert alert-primary" role="alert">
            <?php echo $postAdd;?>
        </div>
        <?php } ?>
        </span>


        <div class="card shadow">
        <h4 class="card-header">Post Add Form</h4>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Post Title</label>
                            <input type="text" class="form-control" name="cat_name" id="cat_name" placeholder="Enter Category Name" />
                    </div> 

                    <div class="mb-3">
                        <label class="form-label">Select Category</label>
                        <div>
                            <select class="form-select" name="catId" id="catId">
                              <option>Select</option>
                              <option>test</option>
                              <option>test01</option>
                            </select>
                        </div>
                    </div> 

                    <div class="mb-3">
                        <label class="form-label">Image One</label>
                            <input type="file" class="form-control" name="imageOne" id="imageOne"/>
                    </div> 

                    <div class="mb-3">
                        <label class="form-label">Description One</label>
=                        <textarea id="classic-editor" name="dis_one"></textarea>
                    </div> 


                    
                    <div class="mb-3">
                        <label class="form-label">Image Two</label>
                            <input type="file" class="form-control" name="imageTwo" id="imageTwo"/>
                    </div> 

                    <div class="mb-3">
                        <label class="form-label">Description Two</label>
=                        <textarea id="classic-editor-two" name="dis_two" id="dis_two"></textarea>
                    </div> 

                    <div class="mb-3">
                        <label class="form-label">Post Type</label>
                        <div>
                            <select class="form-select" name="post_type" id="post_type">
                              <option>Select</option>
                              <option value="1">slider</option>
                              <option value="0">post</option>
                            </select>
                        </div>
                    </div> 

                    <div class="mb-3">
                        <label class="form-label">Post Tags</label>
                            <input type="text" class="form-control" name="post_tags" id="post_tags" placeholder="Enter Post Tag" />
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