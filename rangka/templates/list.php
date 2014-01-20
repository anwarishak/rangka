<?php

include 'header.php';

?>

<div class="page-header rowed-page-header">
  <div class="row">
    <div class="col-md-6"><h1><?php __($page_title) ?></h1></div>
    <div class="col-md-6 text-right list-filters"><strong>332 records.</strong> Order by <a href="">created at</a>, <a href="">updated at</a>, <a href="">first name</a>, <a href="">last name</a>.</div>
  </div>
</div>

<div class="row">
  <div class="col-md-2">
    <p class="extra-margin"><a href="" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span><br>Add new</a></p>
    <p>Select <a href="">all</a>, <a href="">none</a>.</p>
    <p><a href="">Delete</a> selected records.</p>
  </div>
  <div class="col-md-10">
    <div class="row">
      <?php foreach ($models as $model): ?>
      <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-body">
            <?php /*foreach ($list_properties as $key => $list_property): ?>
              <?php if ($key == 0): ?><strong><?php else: ?><small><?php endif; ?>
              <?php if ($list_property['is_method']: ?><?php __($model->$list_property['property_name']()) ?>
              <?php else: ?><<?php __($model->$list_property['property_name']) ?>?php endif;*/ ?>



            <p>
              <a href="" style="text-decoration:none; color:black;"><strong><?php __($model->first_name.' '.$model->last_name) ?></strong></a><br>
              <small>Email: <?php __($model->email) ?></small><br>
              <small>Created: <?php __(date('d j Y h:i', strtotime($model->created_at))) ?></small>
            </p>

            <div class="row">
              <div class="col-md-6 small">
                <input type="checkbox">
              </div>
              <div class="col-md-6 text-right">
                <a href=""><span class="glyphicon glyphicon-pencil"></span></a>
                <a href=""><span class="glyphicon glyphicon-trash"></span></a>
              </div>
            </div>
          </div>
        </div>
      </div>
     <?php endforeach; ?>
    </div>
  </div>
</div>

<?php

include 'footer.php';