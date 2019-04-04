<?php include ("header.php"); ?>

     <div class="container container-pull" style="margin-top: 25px;"> 
      <div style="width:50%; margin: auto;" class="modal-body">
        <h4 class="modal-title" style="text-align:center;">Login To Your Account</h4>
        <div id="output-login"></div>
        <form role="form" action="submit_login.php" id="FromLogin" method="post">
          <div class="form-group">
            <div class="input-group">
              <input style="z-index:0;" type="text" class="form-control" name="username" id="username" placeholder="Username">
              <label for="username" class="input-group-addon glyphicon glyphicon-user"></label>
            </div>
          </div>
          <!-- /.form-group -->
          
          <div class="form-group">
            <div class="input-group">
              <input style="z-index:0;" type="password" class="form-control" name="password" id="password" placeholder="Password">
              <label for="password" class="input-group-addon glyphicon glyphicon-lock"></label>
            </div>
            <!-- /.input-group --> 
          </div>
          <!-- /.form-group -->
          
          <div class="checkbox"> <a href="recover/">Recover username/password</a> </div>
          <!-- /.checkbox -->
          
          <div class="modal-footer btn-login">
            <button class="form-control btn btn-warning btn-font" id="submitButtonLogin">Log In</button>
          </div>
          <!-- /.modal-footer -->
          
        </form>
      </div>
      <!-- /.modal-body --> 
</div> <!-- container -->
      
<?php include("footer.php"); ?>