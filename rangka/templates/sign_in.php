<?php

include 'header.php';

?>

<h1>Sign in</h1>

<form method="post" action="/sign-in">
  <p>
    <label for="email">Username / email address</label>
    <input type="email" id="email" name="email" value="" maxlength="128" class="text" />
  </p>
  <p>
    <label for="password">Password</label>
    <input type="password" name="password" class="text" />
  </p>
  <p>
    <input type="submit" value="Sign in" />
  </p>
</form>

<?php

include 'footer.php';