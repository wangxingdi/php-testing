<?php include("header.php");

if($feat_menu_count_sql = $mysqli->query("SELECT category_id FROM mp_categories WHERE featured = 1"))
{
  $feat_count  = mysqli_num_rows($feat_menu_count_sql);
}

?>

<section class="col-md-2">

<?php include("left_menu.php");

?>
                    
</section><!--col-md-2-->

<section class="col-md-10">

<ol class="breadcrumb">
  <li><i class="fa fa-home"></i></li>
  <li>Categories</li>
  <li class="active">Manage Categories</li>
  <span class="theme-label">MarketPress v<?php echo $Settings['version'];?></span>
</ol>

<div class="page-header">
  <h3>Categories <small>Manage website categories</small></h3>
</div>

<script type="text/javascript">
  
$(document).ready(function(){
//Delete  
$('button.btnDelete').on('click', function (e) {
    e.preventDefault();
    var id = $(this).closest('tr').data('id');
    $('#myModal').data('id', id).modal('show');
});

$('#btnDelteYes').click(function () {
    var id = $('#myModal').data('id');
  var dataString = 'id='+ id ;
    $('[data-id=' + id + ']').remove();
    $('#myModal').modal('hide');
  //ajax
  $.ajax({
type: "POST",
url: "delete_category.php",
data: dataString,
cache: false,
success: function(html)
{
//$(".fav-count")(html);
$("#output").html(html);
}
});
//ajax ends
});
});
</script>

<section class="col-md-12">

<div id="output"></div>
     
<?php

if($_POST)
{
  $catId = $mysqli->escape_string($_GET['id']);

  if(isset($_POST['mf_cat_' . $catId]))
  {

    if($feat_count<5)
    {
      if($CatSql = $mysqli->query("UPDATE mp_categories SET featured = 1 WHERE category_id = '$catId'"))
      {
      printf("<div class='alert alert-success alert-pull'>Featured menu added.</div>");
      }
      else
     {
      printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Try again</div>");
     }
     }
     else
     {
      printf("<div class='alert alert-danger alert-pull'>Only 5 menu items allowed. Remove one from already existing featured menus.</div>");
     }
  }

  if(isset($_POST['rf_cat_' . $catId]))
  {

    if($CatSql = $mysqli->query("UPDATE mp_categories SET featured = 0 WHERE category_id = '$catId'"))
    {
      printf("<div class='alert alert-success alert-pull'>Featured menu removed.</div>");
    }
    else
    {
      printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Try again</div>");
    }
  }
}


error_reporting(E_ALL ^ E_NOTICE);
// How many adjacent pages should be shown on each side?
  $adjacents = 5;
  
  $query = $mysqli->query("SELECT COUNT(*) as num FROM mp_categories ORDER BY cname ASC");
  
  //$query = $mysqli->query("SELECT COUNT(*) as num FROM photos WHERE  photos.active=1 ORDER BY photos.id DESC");
  
  $total_pages = mysqli_fetch_array($query);
  $total_pages = $total_pages['num'];
  
  $targetpage = "manage_categories.php";
  $limit = 15;                //how many items to show per page
  $page = $_GET['page'];
   
  if($page) 
    $start = ($page - 1) * $limit;      //first item to display on this page
  else
    $start = 0;               //if no page var is given, set start to 0
  /* Get data. */
  $result = $mysqli->query("SELECT * FROM mp_categories ORDER BY show_order ASC LIMIT $start, $limit");
   
  //$result = $mysqli->query($sql);
  
  /* Setup page vars for display. */
  if ($page == 0) $page = 1;          //if no page var is given, default to 1.
  $prev = $page - 1;              //previous page is page - 1
  $next = $page + 1;              //next page is page + 1
  $lastpage = ceil($total_pages/$limit);    //lastpage is = total pages / items per page, rounded up.
  $lpm1 = $lastpage - 1;            //last page minus 1
  
  $pagination = "";
  if($lastpage > 1)
  { 
    $pagination .= "<ul class=\"pagination pagination-lg\">";
    //previous button
    if ($page > 1) 
      $pagination.= "<li><a href=\"$targetpage?page=$prev\">&laquo;</a></li>";
    else
      $pagination.= "<li class=\"disabled\"><a href=\"#\">&laquo;</a></li>";  
    
    //pages 
    if ($lastpage < 7 + ($adjacents * 2)) //not enough pages to bother breaking it up
    { 
      for ($counter = 1; $counter <= $lastpage; $counter++)
      {
        if ($counter == $page)
          $pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
        else
          $pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";          
      }
    }
    elseif($lastpage > 5 + ($adjacents * 2))  //enough pages to hide some
    {
      //close to beginning; only hide later pages
      if($page < 1 + ($adjacents * 2))    
      {
        for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
        {
          if ($counter == $page)
            $pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
          else
            $pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";          
        }
        $pagination.= "...";
        $pagination.= "<li><a href=\"$targetpage?page=$lpm1\">$lpm1</a></li>";
        $pagination.= "<li><a href=\"$targetpage?page=$lastpage\">$lastpage</a></li>";    
      }
      //in middle; hide some front and some back
      elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
      {
        $pagination.= "<li><a href=\"$targetpage?page=1\">1</a></li>";
        $pagination.= "<li><a href=\"$targetpage?page=2\">2</a></li>";
        $pagination.= "...";
        for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
        {
          if ($counter == $page)
            $pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
          else
            $pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";          
        }
        $pagination.= "...";
        $pagination.= "<li><a href=\"$targetpage?page=$lpm1\">$lpm1</a></li>";
        $pagination.= "<li><a href=\"$targetpage?page=$lastpage\">$lastpage</a></li>";    
      }
      //close to end; only hide early pages
      else
      {
        $pagination.= "<li><a href=\"$targetpage?page=1\">1</a></li>";
        $pagination.= "<li><a href=\"$targetpage?page=2\">2</a></li>";
        $pagination.= "...";
        for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
        {
          if ($counter == $page)
            $pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
          else
            $pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";          
        }
      }
    }
    
    //next button
    if ($page < $counter - 1) 
      $pagination.= "<li><a href=\"$targetpage?page=$next\">&raquo;</a></li>";
    else
      $pagination.= "<li class=\"disabled\"><a href=\"#\">&raquo;</a></li>";
    $pagination.= "</ul>\n";    
  }
  
  $q= $mysqli->query("SELECT * FROM mp_categories ORDER BY show_order ASC limit $start,$limit");


  $numr = mysqli_num_rows($q);
  if ($numr==0)
  {
  echo '<div class="alert alert-danger">There are no categories to display at this moment.</div>';
  }
  if ($numr>0){
  ?>
       <table class="table table-bordered">

        <thead>

            <tr>
                <th>Category</th>
                <th>Description</th>
                <th>Parent Category</th>
                <th>Manage</th>

            </tr>

        </thead>

        <tbody>
    <?php
  }
  
  while($Row=mysqli_fetch_assoc($q)){
   
   $parent_id = $Row['parent_id'];

    if($Row['featured'] == 1)
    { ?>
           <script>
          
              $(document).ready(function(){
              $("#mf_cat_<?php echo $Row['category_id'];?>").hide();
      });

           </script>
  <?php }

       else
       { ?>
         <script>
          
              $(document).ready(function(){
              $("#rf_cat_<?php echo $Row['category_id'];?>").hide();
      });
              
           </script>
 <?php }

      if($Row['is_sub_cat'] == 1)
      {
        $parent_sql = $mysqli->query("SELECT cname FROM mp_categories WHERE category_id = '$parent_id' ");
        $parent_row = mysqli_fetch_array($parent_sql);
        $parent = $parent_row['cname'];
        $parent_sql->close();
      }
      else
      {
        $parent = 'none';
      }
  
?>        

            <tr class="btnDelete" data-id="<?php echo $Row['category_id'];?>">

                <td><?php echo $Row['cname'];?></td>
        
                <td><?php echo $Row['description'];?></td>

                <td<?php if($parent == "none"){echo " style='color:grey;font-style:italic;'";} ?>><?php echo $parent;?></td>
                
                <td style="width:35%;">
                <!--Testing Modal-->

                <a href="edit_category.php?id=<?php echo $Row['category_id'];?>" class="btn btn-success btnEdit">Edit</a>
         
               <form style="display: inline-block;" method="POST" action="manage_categories.php?id=<?php echo $Row['category_id'];?>">

                <input id="mf_cat_<?php echo $Row['category_id'];?>" name="mf_cat_<?php echo $Row['category_id'];?>" type="submit" class="btn btn-primary btnEdit" value="Make Featured">
                <input id="rf_cat_<?php echo $Row['category_id'];?>" name="rf_cat_<?php echo $Row['category_id'];?>" type="submit" class="btn btn-warning btnDelete" value="Remove Featured">

               </form>

               <button class="btn btn-danger btnDelete">Delete</button>
                                 
                <!--Testing Modal-->
                </td>

            </tr>
<?php } ?>

        </tbody>

    </table>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Confirmation</h4>

            </div>
            <div class="modal-body">
        <p>Are you sure you want to DELETE this Category?</p>
                <p class="text-danger"><small>Please not that all the products belong to this category will also be deleted.</small></p>
                <p class="text-warning"><small>This action cannot be undone.</small></p>    
            </div>
            <!--/modal-body-collapse -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnDelteYes">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
            <!--/modal-footer-collapse -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal --> 

<?php echo $pagination;?>

</section>

</section><!--col-md-10-->

<?php include("footer.php");?>