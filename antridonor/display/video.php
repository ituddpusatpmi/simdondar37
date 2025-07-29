<video loop autoplay muted style="border:5px solid white;width:98.5%;">
        <source src="video/cideo1,mp4" type
        <?php
        foreach(glob('video/*') as $video){
          echo '<source src="'.$video.'"  type="video/mp4">';
        }
        ?>
        Your browser does not support the video tag
        ?>
      </video>


<video width="320" height="240" controls>
  <source src="video/video1.mp4" type="video/mp4">
  <source src="video/video2.mp4" type="video/mp4">

Your browser does not support the video tag.
</video> 