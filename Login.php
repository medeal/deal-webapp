<div id="Login" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
      <form class=form-signin role=form id=LoginForm name=LoginForm  action="PushMail.php" method="POST"><h2 class=form-signin-heading>註冊/登入</h2>
<label for=inputEmail class=sr-only>電子郵件(Email)地址</label> 
<input type=email id=inputEmail name=inputEmail class=form-control placeholder="Email address" required autofocus> 
<label for=inputPassword class=sr-only>密碼</label> 
<input type=password id=inputPassword name=inputPassword class=form-control placeholder=Password required>
<div class=checkbox><label> <input type=checkbox value=remember-me>記住我</label></div>
<div><label><a href='#'  name="forgetpw" id="forgetpw">忘記密碼</a></label></div>
<button id="RegisterLogin" class="btn btn-lg btn-success btn-block" type=submit>Email註冊/登入</button>
 
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>