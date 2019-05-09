<div class="col-ad-top">
<?php if(!empty($Ad1)){
  echo $Ad1;
}?>
</div>

<div class="fb-page" data-href="<?php echo $settings['fbpage'];?>" data-hide-cover="true" data-show-facepile="false" data-show-posts="false"></div>

<div class="side-bar-titles"><h1>Most Popular Products</h1></div>

<?php
  
if($Pop = $mysqli->query("SELECT * FROM mp_products WHERE product_state=1 ORDER BY product_hits DESC LIMIT 3")){

   while($PopRow = mysqli_fetch_array($Pop)){
     $PLink = $PopRow ['pname'];
     $LongTitle = $PopRow['title'];
     $strt = strlen ($LongTitle);
     if ($strt > 29) {
     $tlong = substr($LongTitle,0,26).'...';
     }else{
     $tlong = $LongTitle;}
    
?> 
<div class="side-bar-posts wow fadeInUp">
<a href="<?php echo $PLink;?>/">
<img src="uploads/resizer/336x180/r/<?php echo $PopRow['image'];?>" alt="<?php echo $PopRow['title'];?>" class="img-responsive side-img">
</a>
<a href="<?php echo $PLink;?>/"><h3 class="side-bar-text"><?php echo $tlong;?></h3></a>
</div><!--side-bar-posts-->
<?php
   }$Pop->close();
}else{
     printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");;
}
?>
