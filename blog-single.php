<?php
include_once 'inc/header.php';
include_once 'classes/post.php';
include_once 'classes/comment.php';
include_once 'lib/formate.php';
$fr  = new Format();
$cmt = new Comment();

$post = new Post();
if(isset($_GET['singleId'])) {
  $postId = $_GET['singleId'];
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $comment = $cmt->addComment($_POST);
}
?>


<section class="site-section py-lg">
  <div class="container">

    <div class="row blog-entries element-animate">

      <?php

       $getPost = $post->singlePost($postId);

      if ($getPost) {
        while ($row = mysqli_fetch_assoc($getPost)) { ?>
          <div class="col-md-12 col-lg-8 main-content">
            <img src="admin/<?php echo $row['image_one']; ?>" alt="Image" class="img-fluid mb-5">
            <div class="post-meta">
              <span class="author mr-2"><img src="admin/<?php echo $row['image_one']; ?>" alt="profile iamge hobe" class="mr-2"><?php echo $row['username']; ?></span>&bullet;
              <span class="mr-2"><?php echo $fr->formatDate($row['create_time']); ?></span> &bullet;
              <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
            </div>
            <h1 class="mb-4"><?php echo $row['post_title']; ?></h1>
            <a class="category mb-5" href="#"><?php echo $row['cat_name']; ?></a>

            <div class="post-content-body">
              <p><?php echo $row['description_one']; ?></p>
              <div class="row mb-5">
                <div class="col-md-12 mb-4">
                  <img src="admin/<?php echo $row['image_two']; ?>" alt="Image placeholder" class="img-fluid">
                </div>
              </div>
              <p><?php echo $row['description_two']; ?></p>
            </div>


            <div class="pt-5">
              <p>Categories: <a href="#"><?php echo $row['cat_name'] ?></a>, Tags: <a href="#"><?php echo $row['post_tags']; ?></a></p>
            </div>


            <div class="pt-5">


              <?php 
              $pId = $row['post_id'];
              $allComments = $cmt->allComment($pId);

              if($allComments){
                while ($rows = mysqli_fetch_assoc($allComments)){ 
                  $num_rows = mysqli_num_rows($allComments); 
                  ?>
                      
              <h3 class="mb-5"><?php echo $num_rows;?>  Comments</h3>
              <ul class="comment-list">
                <li class="comment">
                  <div class="vcard">
                    <img src="images/person_1.jpg" alt="Image placeholder">
                  </div>
                      <div class="comment-body">
                        <h3><?php echo $rows['name']; ?></h3>
                        <div class="meta"><?php echo $fr->formatDate($rows['created_time']); ?></div>
                        <p><?php echo $rows['message']; ?></p>
                        <p><a href="#" class="reply rounded">Reply</a></p>
                      </div>

                      </ul>



                    <ul class="comment-list">
                    <li class="comment">
                     <div class="vcard">
                       <img src="images/person_1.jpg" alt="Image placeholder">
                     </div>
                      <div class="comment-body">
                        <h3><?php echo $rows['name']; ?></h3>
                        <div class="meta"><?php echo $fr->formatDate($rows['created_time']); ?></div>
                        <p>
                          <?php
                          $msg_replay = preg_replace('#\<p>[{\w},\s\d"]+\</p>#', "", $rows['admin_replay']);
                          echo $msg_replay;
                        ?></p>
                      </div>
                    </ul>
                  <?php  } }?>

                    


              <!-- END comment-list -->

              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Leave a comment</h3>

                <span>
                  <?php
                  if (isset($comment)) { ?>
                    <div class="alert alert-primary" role="alert">
                      <?php echo $comment; ?>
                    </div>
                  <?php } ?>
                </span>

                <form action="#" method="POST" class="p-5 bg-light">
                <input type="hidden" class="form-control" id="post_id" name="post_id" value="<?php echo $row['post_id'];?>">
                <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $row['userId'];?>">

                  <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" class="form-control" id="name" name="name">
                  </div>
                  <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" class="form-control" id="email" name="email">
                  </div>
                  <div class="form-group">
                    <label for="website">Website</label>
                    <input type="url" class="form-control" id="website" name="website">
                  </div>

                  <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message"  cols="30" rows="10" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <input type="submit" value="Post Comment" class="btn btn-primary">
                  </div>

                </form>
              </div>
            </div>

          </div>



      <!-- END main-content -->

      <div class="col-md-12 col-lg-4 sidebar">
        <div class="sidebar-box search-form-wrap">
          <form action="#" class="search-form">
            <div class="form-group">
              <span class="icon fa fa-search"></span>
              <input type="text" class="form-control" id="s" placeholder="Type a keyword and hit enter">
            </div>
          </form>
        </div>
        <!-- END sidebar-box -->
        <div class="sidebar-box">
          <div class="bio text-center">
            <img src="images/person_2.jpg" alt="Image Placeholder" class="img-fluid">
            <div class="bio-body">
              <h2>Craig David</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam fuga sit molestias minus.</p>
              <p><a href="#" class="btn btn-primary btn-sm rounded">Read my bio</a></p>
              <p class="social">
                <a href="#" class="p-2"><span class="fa fa-facebook"></span></a>
                <a href="#" class="p-2"><span class="fa fa-twitter"></span></a>
                <a href="#" class="p-2"><span class="fa fa-instagram"></span></a>
                <a href="#" class="p-2"><span class="fa fa-youtube-play"></span></a>
              </p>
            </div>
          </div>
        </div>
        <!-- END sidebar-box -->
        <div class="sidebar-box">
          <h3 class="heading">Popular Posts</h3>
          <div class="post-entry-sidebar">
            <ul>
              <li>
                <a href="">
                  <img src="images/img_1.jpg" alt="Image placeholder" class="mr-4">
                  <div class="text">
                    <h4>There’s a Cool New Way for Men to Wear Socks and Sandals</h4>
                    <div class="post-meta">
                      <span class="mr-2">March 15, 2018 </span>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="">
                  <img src="images/img_1.jpg" alt="Image placeholder" class="mr-4">
                  <div class="text">
                    <h4>There’s a Cool New Way for Men to Wear Socks and Sandals</h4>
                    <div class="post-meta">
                      <span class="mr-2">March 15, 2018 </span>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="">
                  <img src="images/img_1.jpg" alt="Image placeholder" class="mr-4">
                  <div class="text">
                    <h4>There’s a Cool New Way for Men to Wear Socks and Sandals</h4>
                    <div class="post-meta">
                      <span class="mr-2">March 15, 2018 </span>
                    </div>
                  </div>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <!-- END sidebar-box -->

        <div class="sidebar-box">
          <h3 class="heading">Categories</h3>
          <ul class="categories">
            <li><a href="#">Food <span>(12)</span></a></li>
            <li><a href="#">Travel <span>(22)</span></a></li>
            <li><a href="#">Lifestyle <span>(37)</span></a></li>
            <li><a href="#">Business <span>(42)</span></a></li>
            <li><a href="#">Adventure <span>(14)</span></a></li>
          </ul>
        </div>
        <!-- END sidebar-box -->

        <div class="sidebar-box">
          <h3 class="heading">Tags</h3>
          <ul class="tags">
            <li><a href="#">Travel</a></li>
            <li><a href="#">Adventure</a></li>
            <li><a href="#">Food</a></li>
            <li><a href="#">Lifestyle</a></li>
            <li><a href="#">Business</a></li>
            <li><a href="#">Freelancing</a></li>
            <li><a href="#">Travel</a></li>
            <li><a href="#">Adventure</a></li>
            <li><a href="#">Food</a></li>
            <li><a href="#">Lifestyle</a></li>
            <li><a href="#">Business</a></li>
            <li><a href="#">Freelancing</a></li>
          </ul>
        </div>
      </div>
      <!-- END sidebar -->

    </div>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="mb-3 ">Related Post</h2>
      </div>
    </div>
    <div class="row">
      <?php
      $relPost =new Post();
      $rel_post = $post->relatedPost($row['cat_id']);
      if($rel_post){
       while($rp =mysqli_fetch_assoc($rel_post)){

  
      ?>

      <div class="col-md-6 col-lg-4">
      <a href="blog-single.php?singleId=<?php echo $row['post_id'];?>" class="a-block sm d-flex align-items-center height-md" style="background-image: url('admin/<?php echo $row['image_two']; ?>'); ">
          <div class="text">
            <div class="post-meta">
              <span class="category"><?php echo $rp['cat_name']; ?></span>
              <span class="mr-2">March 15, 2018 </span> &bullet;
              <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
            </div>
            <h3><?php echo $row['post_title'];?></h3>
          </div>
        </a>
      </div>
      <?php } } ?>

    </div>
  </div>
  <?php } } ?>


</section>
<!-- END section -->

<footer class="site-footer">
  <div class="container">
    <div class="row mb-5">
      <div class="col-md-4">
        <h3>About Us</h3>
        <p class="mb-4">
          <img src="images/img_1.jpg" alt="Image placeholder" class="img-fluid">
        </p>

        <p>Lorem ipsum dolor sit amet sa ksal sk sa, consectetur adipisicing elit. Ipsa harum inventore reiciendis. <a href="#">Read More</a></p>
      </div>
      <div class="col-md-6 ml-auto">
        <div class="row">
          <div class="col-md-7">
            <h3>Latest Post</h3>
            <div class="post-entry-sidebar">
              <ul>
                <li>
                  <a href="">
                    <img src="images/img_6.jpg" alt="Image placeholder" class="mr-4">
                    <div class="text">
                      <h4>How to Find the Video Games of Your Youth</h4>
                      <div class="post-meta">
                        <span class="mr-2">March 15, 2018 </span> &bullet;
                        <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="">
                    <img src="images/img_3.jpg" alt="Image placeholder" class="mr-4">
                    <div class="text">
                      <h4>How to Find the Video Games of Your Youth</h4>
                      <div class="post-meta">
                        <span class="mr-2">March 15, 2018 </span> &bullet;
                        <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="">
                    <img src="images/img_4.jpg" alt="Image placeholder" class="mr-4">
                    <div class="text">
                      <h4>How to Find the Video Games of Your Youth</h4>
                      <div class="post-meta">
                        <span class="mr-2">March 15, 2018 </span> &bullet;
                        <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-1"></div>

          <div class="col-md-4">

            <div class="mb-5">
              <h3>Quick Links</h3>
              <ul class="list-unstyled">
                <li><a href="#">About Us</a></li>
                <li><a href="#">Travel</a></li>
                <li><a href="#">Adventure</a></li>
                <li><a href="#">Courses</a></li>
                <li><a href="#">Categories</a></li>
              </ul>
            </div>

            <div class="mb-5">
              <h3>Social</h3>
              <ul class="list-unstyled footer-social">
                <li><a href="#"><span class="fa fa-twitter"></span> Twitter</a></li>
                <li><a href="#"><span class="fa fa-facebook"></span> Facebook</a></li>
                <li><a href="#"><span class="fa fa-instagram"></span> Instagram</a></li>
                <li><a href="#"><span class="fa fa-vimeo"></span> Vimeo</a></li>
                <li><a href="#"><span class="fa fa-youtube-play"></span> Youtube</a></li>
                <li><a href="#"><span class="fa fa-snapchat"></span> Snapshot</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <p class="small">
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          Copyright &copy; <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
          <script>
            document.write(new Date().getFullYear());
          </script> All Rights Reserved | This template is made with <i class="fa fa-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        </p>
      </div>
    </div>
  </div>
</footer>
<!-- END footer -->

</div>

<!-- loader -->
<div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
    <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
    <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214" />
  </svg></div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/jquery-migrate-3.0.0.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>


<script src="js/main.js"></script>
</body>

</html>