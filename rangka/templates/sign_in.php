<?php

include 'header.php';

?>

<div class="row">
  <div class="col-md-offset-2 col-md-8">

    <div class="page-header">
      <h1>Sign in</h1>
    </div>

    <!--div class="alert alert-danger">Incorrect sign in details</div-->

    <form role="form" class="form-horizontal" method="post" action="/sign-in">
      <div class="form-group">
        <label for="email" class="col-sm-4 control-label">Email address</label>
        <div class="col-sm-8">
          <input type="email" class="form-control" id="email" name="email" value="">
        </div>
      </div>
      <div class="form-group">
        <label for="password" class="col-sm-4 control-label">Password</label>
        <div class="col-sm-8">
          <input type="password" class="form-control" id="password" name="password">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
          <a href="">Forgot your password?</a>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
          <div class="checkbox">
            <label><input type="checkbox"> Stay signed in for 2 weeks</label>
          </div>
        </div>
      </div>
      <hr>
      <div class="form-group text-center">
        <button type="submit" class="btn btn-primary btn-lg">Sign in</button>
      </div>
    </form>

  </div>
</div>

<?php

include 'footer.php';