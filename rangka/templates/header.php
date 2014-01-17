<!DOCTYPE html>
<html>
<head>
  <title>Rangka</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/bootstrap-theme.min.css" rel="stylesheet">
  <link href="/css/rangka.css" rel="stylesheet">
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
</head>
<body>

  <div class="container navbar-container">
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">Rangka</a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <!--li class="active"><a href="#">Link</a></li-->
          <!--li><a href="#">Link</a></li-->
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="/users">Users</a></li>
              <li class="divider"></li>
              <li><a href="/about">About Rangka</a></li>
            </ul>
          </li>
        </ul>
        <div class="nav navbar-right">
          <p class="navbar-text pull-left"><a href="/sign-in" class="navbar-link">Sign in</a> or</p>
          <a href="/create-account" class="btn btn-danger navbar-btn btn-sm pull-right">Create an account</a>
        </div>
      </div>
    </nav>
  </div>

  <div class="container">


