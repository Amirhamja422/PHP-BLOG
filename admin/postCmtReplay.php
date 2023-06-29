<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/comment.php';

$comment = new Comment();
if(isset($_GET['replayId'])){
    $cmtId = base64_decode($_GET['replayId']);
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $replay_msg = $_POST['replay_msg'];
    $addReplay = $comment->addReplay($replay_msg, $cmtId);

}

?>



<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
<div class="row">
    <div class="col-xl-8">

        <span>
        <?php
        if(isset($addReplay)){?>
        <div class="alert alert-primary" role="alert">
            <?php echo $addReplay;?>
        </div>
        <?php } ?>
        </span>


        <div class="card shadow">
        <h4 class="card-header">Comment Replay Form</h4>
            <div class="card-body">
                <?php
                 $select_cmt = $comment->commentSelect($cmtId);
                
                if ($select_cmt) {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($select_cmt)) { ?>
                <form action="" method="POST">

                    <div class="mb-3">
                        <label class="form-label">Replay Message</label>
=                        <textarea id="classic-editor" name="replay_msg"><?php echo $row['admin_replay'];?></textarea>
                    </div>

                    <div>
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                Send Replay
                            </button>
                        </div>
                    </div>
                </form>
                <?php } } ?>

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