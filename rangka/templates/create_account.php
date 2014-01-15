<?php

include 'header.php';

?>

<div class="row">
  <div class="col-md-offset-2 col-md-8">

    <div class="page-header">
      <h1>Create an account</h1>
    </div>

    <!--div class="alert alert-danger">Validation stuff</div-->

    <form role="form" class="form-horizontal">
      <div class="form-group">
        <label for="email" class="col-sm-4 control-label">Email address</label>
        <div class="col-sm-8">
          <input type="email" class="form-control" id="email" name="email">
        </div>
      </div>
      <div class="form-group">
        <label for="password" class="col-sm-4 control-label">Password</label>
        <div class="col-sm-8">
          <input type="password" class="form-control" id="password" name="password">
        </div>
      </div>
      <div class="form-group">
        <label for="repeat_password" class="col-sm-4 control-label">Repeat your password</label>
        <div class="col-sm-8">
          <input type="password" class="form-control" id="repeat_password" name="repeat_password">
        </div>
      </div>
      <hr>
      <div class="form-group text-center">
        <button type="submit" class="btn btn-primary btn-lg">Create account</button> or <a href="/">cancel</a>
      </div>
    </form>

  </div>
</div>

<?php

include 'footer.php';