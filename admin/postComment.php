<?php
// ob_start();
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/post.php';
include '../classes/comment.php';

$post = new post();
$userId = session::get('userId');
$allPost = $post->AllPost($userId);
// $fr = new Format();

$comment = new Comment();
$allComment = $comment->allComments($userId);
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
                        if (isset($viewList)) { ?>
                            <div class="alert alert-primary" role="alert">
                                <?php echo $deleteCat; ?>
                            </div>
                        <?php } ?>
                       </span>
    
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
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Website</th>
                                        <th>Comment</th>
                                        <th>Admin Replay</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($allComment) {
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($allComment)) { ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['website']; ?></td>
                                                <td><?php echo $row['message']; ?></td>   
                                                <td><?php echo $row['admin_replay']; ?></td>
                                                <td>
                                                    <a href="postCmtReplay.php?replayId=<?php echo base64_encode($row['cmtId']); ?>" class="btn btn-success"><i class="fas fa-replay"></i></a>

                                                    <a href="?delId=<?php echo base64_encode($row['cmtId']); ?>" onclick="return confirm('Are You Sure Delete <?php echo $row['cmtId']; ?>')" class="btn btn-danger"><i class="fas fa-arrow-up"></i></a>
                                                    
                                                    <a href="?delId=<?php echo base64_encode($row['cmtId']); ?>" onclick="return confirm('Are You Sure Delete <?php echo $row['cmtId']; ?>')" class="btn btn-primary"><i class="fas fa-arrow-down"></i></a>
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