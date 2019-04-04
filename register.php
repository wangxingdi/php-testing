<?php include ("header.php"); ?>
 
 <div class="container container-pull" style="margin-top: 25px;"> 
  <div style="width:50%; margin: auto;" class="modal-body">
    <h4 class="modal-title" style="text-align:center;">CREATE AN ACCOUNT</h4>  
  
        <div id="output-register"></div>
        <form action="submit_user.php" id="FromRegister" method="post" >
  <div class="form-group">
    <label for="uName">Username</label>
    <input type="text" class="form-control" name="uName" id="uName" required>
    </div>
    <div class="form-group">
    <label for="uEmail">Email</label>
    <input type="text" class="form-control" name="uEmail" id="uEmail" required>
    </div>
    <div class="form-group">
    <label for="uPassword">Password</label>
    <input type="password" class="form-control" name="uPassword" id="uPassword" required>
    </div>
    <div class="form-group">
    <label for="cPassword">Confirm Password</label>
    <input type="password" class="form-control" name="cPassword" id="cPassword" required>
     </div>
          
          <div class="modal-footer btn-register">
            <button class="form-control btn btn-warning btn-font" id="submitButtonRegister">Sign Up</button>
          </div>
          <!-- /.modal-footer -->
          
        </form>
      </div><!-- /.modal-body --> 
</div> <!-- container -->

<?php include("footer.php"); ?>