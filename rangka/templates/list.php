<?php

include 'header.php';

?>

<div class="page-header">
  <h1><?php __($page_title) ?> <span class="text-muted">(635 records)</span></h1>
</div>

<div class="row">
  <div class="col-md-2">
    <p><a href="" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span><br>Add new</a></p>
    <br>
    <p>Order by <a href="" class="active">first name</a>, <a href="">last name</a>, <a href="">created at</a> or <a href="">updated at</a>.</p>
    <p><a href="">Show</a> or <a href="">hide</a> archived.</p>
  </div>
  <div class="col-md-10">
    <div class="row">
      <?php foreach ($models as $model): ?>
      <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-body">
            <strong><?php __($model->first_name.' '.$model->last_name) ?></strong><br>
            <small>Email: <?php __($model->email) ?><br>
            Created: <?php __(date('d j Y h:i', strtotime($model->created_at))) ?></small>
          </div>
        </div>
      </div>
     <?php endforeach; ?>
    </div>
  </div>
</div>

<?php

include 'footer.php';