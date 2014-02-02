<?php

abstract class model
{
  protected $properties = array();
  protected $table_name = '';
  protected $parents = array();
  protected $children = array();
  protected $is_sortable = false;

  public function __construct()
  {
    $this->add_property('id');
    $this->add_properties();
    if ($this->is_sortable) $this->add_property('sort_order');
    $this->add_property('created_at', 'DATETIME');
    $this->add_property('created_by', 'INT');
    $this->add_property('updated_at', 'DATETIME');
    $this->add_property('updated_by', 'INT');

    $this->add_parents();
  }

  public function __get($name)
  {
    $result = '';

    if ($name == 'table_name') $result = $this->table_name;
    elseif ($name == 'properties') $result = $this->properties;
    elseif ($name == 'property_names') $result = array_keys($this->properties);
    elseif (array_key_exists($name, $this->parents)) $result = $this->parents[$name];
    elseif (array_key_exists($name, $this->children)) $result = $this->children[$name];
    elseif (array_key_exists($name, $this->properties)) $result = $this->properties[$name]['value'];

    return $result;
  }

  public function __set($name, $value)
  {
    if (array_key_exists($name, $this->properties)) $this->properties[$name]['value'] = $value;
    elseif (ENV != 'LIVE') throw new Exception('Property '.$name.' does not exist');

    return true;
  }

  protected function add_property($name, $datatype='INT', $length='11')
  {
    $this->properties[$name] = array(
      'name' => $name,
      'value' => '',
      'datatype' => $datatype,
      'length' => $length
    );
  }

  protected function add_parent($parent_name)
  {
    $this->parents[$parent_name] = new $parent_name;
  }

  abstract protected function add_properties();

  protected function add_parents() {}

  protected function presave() {}

  protected function postsave() {}

  public function save()
  {
    $this->presave();

    $database = database::get_instance();

    if ($this->is_sortable && $this->sort_order == '')
    {
      $sql = "SELECT MAX(`sort_order`) FROM `".$this->table_name."`;";
      $max_sort_order = $database->get_value($sql);
      $this->sort_order = $max_sort_order+1;
    }

    $this->updated_at = date('Y-m-d H:i:s');
    $property_names = $this->property_names;
    array_shift($property_names);

    if ($this->id)
    {
      $sql = "UPDATE `".$this->table_name."`
              SET `".implode("` = ?, `", $property_names)."` = ?
              WHERE `id` = ?;";

      $values = array();

      foreach ($property_names as $property_name)
      {
        $values[] = $this->$property_name;
      }

      $values[] = $this->id;
      $database->query($sql, $values);
    }
    else
    {
      $sql = "INSERT INTO `".$this->table_name."`
              (`".implode('`, `', $property_names)."`)
              VALUES
              (?".str_repeat(', ?', count($property_names)-1).");";

      $this->created_at = $this->updated_at;
      $values = array();

      foreach ($property_names as $property_name)
      {
        $values[] = $this->$property_name;
      }

      $database->query($sql, $values);
      $this->id = $database->get_last_insert_id();
    }

    $this->postsave();

    return true;
  }

  protected function preload() {}

  protected function postload() {}

  public function load($load_parents=true)
  {
    $result = false;

    if ($this->id)
    {
      $this->preload();

      $sql = "SELECT `".$this->table_name."`.`".implode("`, `".$this->table_name."`.`", $this->property_names)."` ";

      if ($load_parents) foreach ($this->parents as $parent)
      {
        $sql .= ", `".$parent->table_name."`.`".implode("`, `".$parent->table_name."`.`", $parent->property_names)."` ";
      }

      $sql .= "FROM `".$this->table_name."` ";

      if ($load_parents) foreach ($this->parents as $parent)
      {
        $sql .= "INNER JOIN `".$parent->table_name."` ON `".$parent->table_name."`.`id` = `".$this->table_name."`.`".get_class($parent)."_id` ";
      }

      $sql .= "WHERE `".$this->table_name."`.`id` = ?;";

      $database = database::get_instance();
      $rows = $database->query($sql, array($this->id));

      if (count($rows))
      {
        $column_count = 0;

        foreach ($this->property_names as $property_name)
        {
          $this->$property_name = $rows[0][$column_count];
          $column_count++;
        }

        if ($load_parents) foreach ($this->parents as $parent) foreach ($parent->property_names as $property_name)
        {
          $parent_name = get_class($parent);
          $this->$parent_name->$property_name = $rows[0][$column_count];
          $column_count++;
        }

        $this->postload();
        $result = true;
      }
    }

    return $result;
  }

  protected function predelete() {}

  protected function postdelete() {}

  public function delete()
  {
    $this->predelete();

    $sql = "DELETE FROM `".$this->table_name."` WHERE `id` = ?";
    $database = database::get_instance();
    $database->query($sql, array($this->id));

    $this->postdelete();
  }

  public function sort($sort_id)
  {
    if ($this->is_sortable)
    {
      $class_name = get_class($this);
      $model_to_sort = $class_name::get_by_id($sort_id);
      $tmp_sort_order = $this->sort_order;
      $this->sort_order = $model_to_sort->sort_order;
      $model_to_sort->sort_order = $tmp_sort_order;
      $this->save();
      $model_to_sort->save();
    }
  }

  public static function get_by_id($id)
  {
    $result = false;
    $class_name = get_called_class();
    $obj = new $class_name;
    $obj->id = $id;
    $obj->load();
    if ($obj->created_at) $result = $obj;

    return $result;
  }

  public static function get_many($order_by='', $start=0, $limit=50, $filters=array())
  {
    $results = array();
    $class_name = get_called_class();
    $obj = new $class_name;

    $sql = "SELECT `id`
            FROM `".$obj->table_name."`
            WHERE 1 = 1 ";

    foreach ($filters as $filter)
    {
      $sql .= "AND `".$filter['name']."` ";
      $sql .= $filter['operation'] == 'IN' ? "IN (?) " : $filter['operation']." ? ";
    }

    if ($order_by)
    {
      $sql .= "ORDER BY ".$order_by." ";
    }
    elseif ($obj->is_sortable)
    {
      $sql .= "ORDER BY `sort_order` ASC ";
    }

    $sql .= "LIMIT ".$start.", ".$limit.";";

    $database = database::get_instance();
    $values = array();
    foreach ($filters as $filter) $values[] = $filter['value'];
    $rows = $database->query($sql, $values);

    foreach ($rows as $row)
    {
      $results[] = $class_name::get_by_id($row[0]);
    }

    return $results;
  }

  public static function get_total()
  {
    $class_name = get_called_class();
    $obj = new $class_name;

    $sql = "SELECT COUNT(`id`)
            FROM `".$obj->table_name."`;";

    $database = database::get_instance();
    $result = $database->get_value($sql);

    return $result;
  }

  public static function get_total_by_dates($date_start, $date_end)
  {
    $class_name = get_called_class();
    $obj = new $class_name;

    $sql = "SELECT COUNT(`id`)
            FROM `".$obj->table_name."`
            WHERE `created_at` >= ?
            AND `created_at` < ?;";

    $database = database::get_instance();
    $result = $database->get_value($sql, array($date_start, $date_end));

    return $result;
  }


  protected function format_datetime($date_str)
  {
    return date('j M Y H:i', strtotime($date_str));
  }

  public function format_created_at()
  {
    $result = $this->created_at > 0 ? $this->format_datetime($this->created_at) : '-';
    return $result;
  }

  public function format_updated_at()
  {
    $result = $this->updated_at > 0 ? $this->format_datetime($this->updated_at) : '-';
    return $result;
  }
}