<?php

include 'header.php';

?>

<div class="page-header rowed-page-header">
  <div class="row">
    <div class="col-md-12"><h1><?php __($page_title) ?> <small><?php __($page_subtitle) ?></small></h1></div>
  </div>
</div>

<div class="row">
  <div class="col-md-2">
    <p class="extra-margin"><a href="<?php __('/'.$controller_name) ?>" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span><br>Back</a></p>
  </div>
  <div class="col-md-8">
    <div class="row">
      <form class="form-horizontal" role="form">
        <?php foreach ($edit_items as $edit_item): ?>
        <div class="form-group">
          <label for="<?php __($edit_item['property_name']) ?>" class="col-sm-4 control-label"><?php __($edit_item['title']) ?></label>
          <div class="col-sm-8">
            <input type="text" id="<?php __($edit_item['property_name']) ?>" name="<?php __($edit_item['property_name']) ?>" class="form-control" id="inputEmail3" value="<?php __($form->$edit_item['property_name']) ?>">
          </div>
        </div>
        <?php endforeach; ?>
        <hr>
        <div class="form-group text-center">
          <button type="submit" class="btn btn-primary btn-lg">Save</button>
          or <a href="">go back</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php

include 'footer.php';