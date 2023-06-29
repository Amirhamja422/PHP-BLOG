<?php
// ob_start();
// include '../lib/session.php';
// Session::checkSession();
include 'inc/header.php';
include 'inc/sidebar.php';
// include '../lib/formate.php';
include '../classes/post.php';

$post = new post();
$userId = session::get('userId');
$allPost = $post->AllPost($userId);
// $fr = new Format();


?>

<!-- <?php echo session::get('username'); ?> -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            // if(!isset($_GET['id'])){
                            // echo '<meta http-equiv="refresh" content="0;url=http://domain.com?a=1&b=2';
                            // }
                            ?>

                            <!-- <span>
                        <?php
                        if (isset($viewList)) { ?>
                            <div class="alert alert-primary" role="alert">
                                <?php echo $deleteCat; ?>
                            </div>
                        <?php } ?>
                    </span>
                 -->
                 <?php 
                 if(isset($_GET['viewId'])){
    $id = $_GET['viewId'];
    
    $viewList = $post->allView($id);
  
}

?>

                            <h4 class="card-header">list</h4>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Post Title</th>
                                        <th>Category ID</th>
                                        <th>Description One</th>
                                        <th>Description Two</th>
                                        <th>Post Type</th>
                                        <th>Post Tags</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if ($allPost) {
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($allPost)) { ?>

                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $row['post_title']; ?></td>
                                                <td><?php echo $row['cat_id']; ?></td>
                                                <td><?php echo $row['description_one']; ?></td>
                                                <td><?php echo $row['description_two']; ?></td>
                                                <td>
                                                    <?php
                                                    if ($row['post_type'] == 1) {
                                                        echo "Post";
                                                    } else {
                                                        echo "Slider";
                                                    }


                                                    ?>
                                                </td>
                                                <td><?php echo $row['post_tags']; ?></td>
                                                <td style="display:flex;">
                                                    <a href="catEdit.php?editId=<?php echo base64_encode($row['cat_id']); ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>

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