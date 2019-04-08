<?php include("header.php");?>

<section class="col-md-2">

<?php include("left_menu.php");?>
                    
</section><!--col-md-2-->

<section class="col-md-10">

<ol class="breadcrumb">
  <li><i class="fa fa-home"></i></li>
  <li class="active">Add New Product</li>
  <span class="theme-label">Amazon Dominator v<?php echo $Settings['version'];?></span>
</ol>

<div class="page-header">
  <h3>Add New Product <small>Add products</small></h3>
</div>

<script src="js/bootstrap-filestyle.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>

<script>

$(function(){

$(":file").filestyle({iconName: "glyphicon-picture", buttonText: "Select Photo"});

});

$(document).ready(function()
{
    $('#AddProduct').on('submit', function(e)
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
   

<div id="output"></div>

<form action="submit_product.php" id="AddProduct" enctype="multipart/form-data" method="post">

<div class="form-group">
<label for="category">Category</label>

<select name="category" class="form-control" id="category">
<option value="0">Select a Category</option>
<?php
if($ProductCat = $mysqli->query("SELECT * FROM categories WHERE is_sub_cat=0 ORDER BY cname ASC")){

    while ($ProductCatRow = mysqli_fetch_array($ProductCat)){
    
?>   
  <option value="<?php echo $ProductCatRow['id'];?>"><?php echo $ProductCatRow['cname'];?></option>
<?php     
  }
$ProductCat->close();

}else{
     printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");;
}
?>
</select>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $("#category").change(function(){
        var parent = $("#category option:selected").val();
        $.ajax({
            type: "POST",
            url: "get-sub-cats.php",
            data: { parent : parent } 
        }).done(function(data){
            $("#sub-cats").html(data);
        });
    });
});
</script>

<div id="sub-cats" class="form-group"></div>

<div class="form-group">
<label for="mName">Title</label>
<input type="text" name="mName" id="mName" class="form-control" placeholder="Add a catchy title">
</div>


<div class="form-group">
<label for="aff">Product affiliate / purchase link</label>
<input type="text"  name="aff" id="aff" class="form-control" placeholder="Your Affiliate Link to the product">
</div>


<div class="form-group">
<label for="disc">Description</label>
<textarea name="disc" id="disc" cols=40 rows=5 class="form-control" onkeyup="countChar(this)" placeholder="Product description (Maximum 250 characters)"></textarea>
<span id="charNum">250</span> out of 250 characters left
</div>

<div class="form-group">
<label for="file">Product Image</label>
<input type='file' class="file" name="mFile" id="mFile"/>
</div>

<div class="form-group">
<label for="price">Price (Without &#36; sign):</label>
<input type="text" name="price" id="price" class="form-control" placeholder="Product price">
</div>

<div class="form-group">
<label for="meta_desc">Meta Description</label>
<textarea name="meta_desc" id="meta_desc" cols=40 rows=3 class="form-control" placeholder="Add an SEO friendly meta description here.."></textarea>
</div>

</div><!-- panel body -->

<div class="panel-footer clearfix">

<button type="submit" id="submitButton" class="btn btn-default btn-success btn-lg pull-right">Add Product</button>

</div><!--panel-footer clearfix-->

</form>


</div><!--panel panel-default-->  

</section>

</section><!--col-md-10-->

<?php include("footer.php");?>