<?php

include 'header.php';

?>

<div class="row">
  <div class="col-md-offset-3 col-md-6">
    <div class="panel panel-default">
      <div class="panel-body">

        <!--div class="alert alert-danger">Incorrect sign in details</div-->

        <form role="form">
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" value="">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <div class="checkbox">
            <label><input type="checkbox" name="remember" value="1"> Remember me for 2 weeks</label>
          </div>
          <button type="submit" class="btn btn-default">Sign in</button>
        </form>

        <p>Not a member? <a href="/register">Register instead</a></p>

      </div>
    </div>
  </div>
</div>

<?php

include 'footer.php';