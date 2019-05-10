<?php include("header.php");?>

<section class="col-md-2">

<?php include("left_menu.php");?>
                    
</section><!--col-md-2-->

<section class="col-md-10">

<ol class="breadcrumb">
  <li>Admin CP</li>
  <li>Product Listings</li>
  <li>Products</li>
  <li class="active">Edit Products</li>
  <span class="theme-label">Amazon Dominator v<?php echo $Settings['version'];?></span>
</ol>

<div class="page-header">
  <h3>Edit Products <small>Edit/update products</small></h3>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-filestyle@1.2.1/src/bootstrap-filestyle.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-form@4.2.2/dist/jquery.form.min.js"></script>

<script>

$(function(){

$(":file").filestyle({iconName: "glyphicon-picture", buttonText: "Select Photo"});

});

$(document).ready(function()
{
    $('#form-add-product').on('submit', function(e)
    {
        e.preventDefault();
        $('#submit').attr('disabled', ''); // disable upload button
        //show uploading message
        $("#output").html('<div class="alert alert-info" role="alert">Updating... Please Wait...</span></div>');
        $(this).ajaxSubmit({
        target: '#output',
        success:  afterSuccess //call function after success
        });
    });
});
 
function afterSuccess()
{
    $('#submit').removeAttr('disabled'); //enable submit button
    //$('#output').html('');
}

function countChar(val) {
        var len = val.value.length;
        if (len >= 250) {
          val.value = val.value.substring(0, 250);
        } else {
          $('#charNum').text(250 - len);
        }
      };
</script>

<section class="col-md-8">

<div class="panel panel-default">

    <div class="panel-body">
    
<?php
$id = $mysqli->escape_string($_GET['id']);
if($products_result_set = $mysqli->query("SELECT * FROM mp_products WHERE product_id='$id'")){
    $products_row = mysqli_fetch_array($products_result_set);
    $SelectedCat = $products_row['category_id'];
    $products_result_set->close();
}else{
   printf("<div class='alert alert-danger alert-pull'>产品查询失败(edit_product.php)</div>");
}
?>    

<div id="output"></div>

<form action="update_product.php?id=<?php echo $id;?>" id="form-add-product" enctype="multipart/form-data" method="post">

<div class="form-group">
<label for="category">Category</label>

<select name="category" class="form-control" id="category">
<?php
if($CatSelected = $mysqli->query("SELECT * FROM categories WHERE id='$SelectedCat' LIMIT 1")){

$CatSelectedRow = mysqli_fetch_array($CatSelected);

$SelectedCat = $CatSelectedRow['id'];
    
?>   
  <option value="<?php echo $CatSelectedRow['id'];?>"><?php echo $CatSelectedRow['cname'];?></option>
<?php     
  
$CatSelected->close();

}else{
     printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");
}
?>

<?php
if($CatSql = $mysqli->query("SELECT * FROM categories WHERE id!='$SelectedCat' ORDER BY show_order ASC")){

    while ($CatRow = mysqli_fetch_array($CatSql)){
    
?>   
  <option value="<?php echo $CatRow['id'];?>"><?php echo $CatRow['cname'];?></option>
<?php     
  }
$CatSql->close();
}else{
     printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");
}
?>
</select>
</div>

<div class="form-group">
<label for="mName">Title</label>
<input type="text" name="mName" id="mName" class="form-control" placeholder="Add a catchy title" value="<?php echo $PostRow['title'];?>">
</div>


<div class="form-group">
<label for="aff">Product affiliate / purchase link</label>
<input type="text"  name="aff" id="aff" class="form-control" placeholder="Your Affiliate Link to the product" value="<?php echo $PostRow['aff_url'];?>">
</div>


<div class="form-group">
<label for="disc">Description</label>
<textarea name="disc" id="disc" cols=40 rows=5 class="form-control" onkeyup="countChar(this)" placeholder="Product description (Maximum 250 characters)"><?php echo $PostRow['discription'];?></textarea>
<span id="charNum">250</span> out of 250 characters left
</div>

<div class="form-group">
<label for="file">Product Image</label>
<input type='file' class="file" name="mFile" id="mFile"/>
</div>

<div class="form-group">
<label for="price">Price (Without &#36; sign):</label>
<input type="text" name="price" id="price" class="form-control" placeholder="Product price" value="<?php echo $PostRow['price'];?>">
</div>

<div class="form-group">
<label for="meta_desc">Meta Description</label>
<textarea name="meta_desc" id="meta_desc" cols=40 rows=3 class="form-control" placeholder="Add an SEO friendly meta description here.."><?php echo $PostRow['meta_description'];?></textarea>
</div>


</div><!-- panel body -->

<div class="panel-footer clearfix">

<button type="submit" id="submitButton" class="btn btn-default btn-success btn-lg pull-right">Update Product</button>

</div><!--panel-footer clearfix-->

</form>


</div><!--panel panel-default-->  

</section>

</section><!--col-md-10-->

<?php include("footer.php");?>