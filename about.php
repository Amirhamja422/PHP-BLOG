<?php include 'inc/header.php';?>
<?php include 'inc/slider.php';?>
<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/classes/siteOption.php');
 
$about_us = new siteOption();

?>

    <section class="site-section pt-5">
      <div class="container">
        
        <div class="row blog-entries">
          <div class="col-md-12 col-lg-8 main-content">
            
            <div class="row">

              <?php
             $allAbout = $about_us->aboutInfo();
              if($allAbout){
              while($allAbouts = mysqli_fetch_assoc($allAbout)){?>
              <div class="col-md-12">
                <h2 class="mb-4"><?php echo $allAbouts['userName'];?></h2>
                <p class="mb-5"><img src="images/img_6.jpg" alt="Image placeholder" class="img-fluid"></p>
                <p><?php echo $allAbouts['userDetails'];?></p>

              </div>
              <?php }} ?>  

            </div>

            <div class="row mb-5 mt-5">
              <div class="col-md-12 mb-5">
                <h2>My Latest Posts</h2>
              </div>
              <div class="col-md-12">
                <?php 
                    $latestPosts = $about_us->latestPost();
                    if($latestPosts){
                    while($row = mysqli_fetch_assoc($latestPosts)){?>
              
                <div class="post-entry-horzontal">
                  <a href="blog-single.html">
                    <div class="image" style="background-image: url(images/img_10.jpg);"></div>
                    <span class="text">
                      <div class="post-meta">
                        <span class="author mr-2"><img src="images/person_1.jpg" alt="Colorlib"> <?php echo $row['username'];?>
                        <span class="mr-2">March 15, 2018 </span> &bullet;
                        <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                      </div>
                      <h2><?php echo $row['post_title']; ?></h2>
                    </span>
                  </a>
                </div>
              <?php }}?>

                <!-- END post -->



              </div>
            </div>

            <div class="row">
              <div class="col-md-12 text-center">
                <nav aria-label="Page navigation" class="text-center">
                  <ul class="pagination">
                      <li class="page-item  active"><a class="page-link" href="#">&lt;</a></li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item"><a class="page-link" href="#">4</a></li>
                      <li class="page-item"><a class="page-link" href="#">5</a></li>
                      <li class="page-item"><a class="page-link" href="#">&gt;</a></li>
                    </ul>
                </nav>
              </div>
            </div>

            

          </div>

          <!-- END main-content -->
<?php include 'inc/sidebar.php';?>   
<?php include 'inc/footer.php';?>
