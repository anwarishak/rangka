<?php

include 'header.php';

?>

<div class="page-header rowed-page-header">
  <div class="row">
    <div class="col-md-6"><h2><?php __($page_title) ?></h2></div>
    <div class="col-md-6 text-right list-filters"><strong>332 records.</strong> Order by <a href="">created at</a>, <a href="">updated at</a>, <a href="">first name</a>, <a href="">last name</a>.</div>
  </div>
</div>

<div class="row">
  <div class="col-md-2">
    <p class="extra-margin"><a href="<?php __('/'.$controller_name.'?add') ?>" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span><br>Add new</a></p>
    <p>Select <a href="">all</a>, <a href="">none</a>.</p>
    <p><a href="">Delete</a> selected records.</p>
  </div>
  <div class="col-md-10">
    <div class="row">
      <?php foreach ($models as $model): ?>
      <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-body list-item">
            <a href="<?php __('/'.$controller_name.'/'.$model->id.'?edit') ?>">
              <p><?php

              foreach ($list_items as $key => $list_item)
              {
                if ($key == 0) echo '<strong>';
                else echo '<small>';

                if ($list_item['title']) __($list_item['title'].': ');

                if ($list_item['method_name']) __($model->$list_item['method_name']());
                elseif ($list_item['property_name']) __($model->$list_item['property_name']);

                if ($key == 0) echo '</strong>';
                else echo '</small>';

                echo '<br>';
              } ?></p>
            </a>
            <div class="row">
              <div class="col-md-3">
                <input type="checkbox">
              </div>
              <div class="col-md-9 text-right">
                <form method="post" action="<?php __('/'.$controller_name.'/'.$model->id) ?>">
                  <input type="hidden" name="_METHOD" value="DELETE">
                  <div class="btn-group btn-group-xs">
                    <a href="<?php __('/'.$controller_name.'/'.$model->id.'?edit') ?>" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></button>
                  </div>
                </form>
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