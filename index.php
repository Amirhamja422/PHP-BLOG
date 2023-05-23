
<?php 
include_once 'inc/header.php';
include_once 'inc/slider.php';
include_once 'lib/formate.php';
include_once 'classes/post.php';
$post = new post();
$fr  = new Format();

?>



      <section class="site-section py-sm">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <h2 class="mb-4">Latest Posts</h2>
            </div>
          </div>
          <div class="row blog-entries">
            <div class="col-md-12 col-lg-8 main-content">
              <div class="row">
              <?php 
                $limit =2;
                if(isset($_GET['page'])){
                 $page = $_GET['page'];
                }else{
                  $page =1;
                }
                $offset = ($page -1)*$limit;
                $getPost = $post->latestPost($offset,$limit);
                if($getPost){
                  while($row = mysqli_fetch_assoc($getPost)){?>

                <div class="col-md-6">
                  <a href="blog-single.php?singleId=<?php echo $row['post_id'];?>" class="blog-entry element-animate" data-animate-effect="fadeIn">
                  <img src="admin/<?php echo $row['image_one'];?>" alt="Image placeholder">
                    <div class="blog-content-body">
                      <div class="post-meta">
                        <span class="author mr-2"><img src="images/person_1.jpg" alt="Colorlib"><?php echo $row['username'];?></span>&bullet;
                        <span class="mr-2"><?php echo $fr->formatDate($row['create_time']);?> </span> &bullet;
                        <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                      </div>
                      <h2><?php echo $row['post_title'] ;?></h2>
                    </div>
                  </a>
                </div>

                <?php }} ?>




  

              </div>

              <div class="row mt-5">
                <div class="col-md-12 text-center">
                  <nav aria-label="Page navigation" class="text-center">
                    <?php 
                    $num_page= $post->numPost();
                    if($num_page){
                     $total_record =mysqli_num_rows($num_page);    
                     $total_page = ceil($total_record/$limit);   
                      ?>

                     <ul class="pagination">
                     <li class="page-item  active"><a class="page-link" href="#">&lt;</a></li>
                     
                     <?php 
                     for($i=1;$i<$total_page; $i++){?>

                     <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i;?></a></li>

                     <?php }?>

                     <li class="page-item"><a class="page-link" href="#">&gt;</a></li>
                   </ul>
                   <?php } ?>


                  </nav>
                </div>
              </div>

            </div>
            <!-- END main-content -->
<?php include 'inc/sidebar.php';?>   
<?php include 'inc/footer.php';?>
