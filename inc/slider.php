<?php
// $filepath = realpath(dirname(__FILE__));
// include_once ($filepath.'../classes/post.php');
// include_once ($filepath.'../lib/format.php');

include_once 'C:\laragon\www\personal-webpage\classes/post.php';
// include_once 'C:\laragon\www\personal-webpage\lib/format.php';

 $post = new post();
//  $fr = new Format();

?>



<section class="site-section pt-5 pb-5">
  <?php  $slider_post = $post->sliderPost();
  ?>
        <div class="container">
          <div class="row">
            <div class="col-md-12">

              <div class="owl-carousel owl-theme home-slider">         

               <?php
               
          
                if($slider_post){
                  while ($row = mysqli_fetch_assoc($slider_post)) { ?>
              
                   <div>
                   <a href="blog-single.php?singleId=<?php echo $row['post_id'];?>" class="a-block d-flex align-items-center height-lg" style="background-image: url('admin/<?php echo $row['image_one'];?>'); ">
                      <div class="text half-to-full">
                        <span class="category mb-5">Food</span>
                        <div class="post-meta">
                          
                          <span class="author mr-2"><img src="admin/<?php echo $row['pro_image'];?>" alt="Colorlib"><?php echo $row['username']?></span>&bullet;
                          <span class="mr-2">March 15, 2018 </span> &bullet;
                          <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                          
                        </div>
                        <h3><?php echo $row['post_title'];?></h3>
                        <p><?php echo $row['description_one']?></p>
                      </div>
                    </a>
                  </div>
               <?php }} ?>


 
              </div>
              
            </div>
          </div>
          
        </div>


      </section>
      <!-- END section -->