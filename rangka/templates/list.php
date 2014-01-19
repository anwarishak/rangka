<?php

include 'header.php';

?>

<div class="page-header">
  <h1><?php __($page_title) ?></h1>
</div>

<div class="row">
  <div class="col-md-2">
    +
  </div>
  <div class="col-md-10">
    <div class="row">
      <?php foreach ($models as $model): ?>
      <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-body">
            <strong><?php __($model->first_name.' '.$model->last_name) ?></strong>
            <?php __($model->email) ?><br>
            <?php __(date('d j Y h:i', strtotime($model->created_at))) ?>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-body">
            <strong><?php __($model->first_name.' '.$model->last_name) ?></strong>
            <?php __($model->email) ?><br>
            <?php __(date('d j Y h:i', strtotime($model->created_at))) ?>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-body">
            <strong><?php __($model->first_name.' '.$model->last_name) ?></strong>
            <?php __($model->email) ?><br>
            <?php __(date('d j Y h:i', strtotime($model->created_at))) ?>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-body">
            <strong><?php __($model->first_name.' '.$model->last_name) ?></strong>
            <?php __($model->email) ?><br>
            <?php __(date('d j Y h:i', strtotime($model->created_at))) ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    </div>
  </div>
</div>

<?php

include 'footer.php';