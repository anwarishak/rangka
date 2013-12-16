<?php

include 'header.php';

?>

<div class="page-header">
  <h1>Sign in</h1>
</div>

<form class="form-horizontal" role="form" method="post" action="/sign-in">
  <div class="form-group">
    <label for="email" class="col-md-3 control-label">Username / email address</label>
    <div class="col-md-4">
      <input type="email" id="email" name="email" class="form-control" value="" maxlength="128" />
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-md-3 control-label">Password</label>
    <div class="col-md-4">
      <input type="password" name="password" class="form-control" />
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-offset-3 col-md-4">
      <div class="checkbox">
        <label><input type="checkbox" id="remember" name="remember" value="1"> Remember me for 2 weeks</label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-offset-3 col-md-4">
      <button type="submit" class="btn btn-default">Sign in</button>
    </div>
  </div>
</form>

<?php

include 'footer.php';