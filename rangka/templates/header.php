<!DOCTYPE html>
<html>
<head>
  <title>Rangka</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--link href="/css/bootstrap.min.css" rel="stylesheet"-->
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <link href="/css/rangka.css" rel="stylesheet">
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
</head>
<body>

<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Rangka</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/">Dashboard</a></li>
        <li><a href="/">Reports</a></li>
        <li class="active"><a href="/users">Users</a></li>
      </ul>
      <div class="nav navbar-right navbar-text">
        Signed in as <a href="/profile" class="navbar-link">Anwar Ishak</a>. <a href="/sign-out" class="navbar-link">Sign out</a>.
        <!--a href="">Sign in</a> or <a href="">create an account</a-->
      </div>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<?php if ($controller_name == 'home'): ?>
<div class="container no-subnav">
<?php else: ?>
<div class="container">
  <ul class="nav nav-pills small">
    <li class="active"><a href="/users">Users</a></li>
    <li><a href="/roles">Roles</a></li>
    <li><a href="/permissions">Permissions</a></li>
  </ul>
</div>

<div class="container">
<?php endif; ?>
