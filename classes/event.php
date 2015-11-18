<?php

class event{
  public $id;
  public $type;
  public $team;
  public $title;
  public $text;
  public $start;
  public $end;

  public static $validate = array(
    "type" => array(
                      "type"=>"int",
                      "required"=>true),
    "team" => array(
                      "type"=>"int",
                      "required"=>true),
    "title" => array(
                      "type"=>"freetext",
                      "required"=>true),
    "text" => array(
                      "type"=>"freetext",
                      "required"=>true),
    "start" => array(
                      "type"=>"date",
                      "required"=>true),
    "end" => array(
                      "type"=>"date",
                      "required"=>true),
  );

 function __construct($arr){
   $this->id = $arr['id'];
   $this->type = $arr['type'];
   $this->team = $arr['team'];
   $this->title = $arr['title'];
   $this->text = $arr['text'];
   $this->start = $arr['start'];
   $this->end = $arr['end'];
 }
 /**
  * Echos the icon for event
  */
 public function getIcon(){
    switch($this->type){
      case 10:
          echo '<i title="Match" class="fa fa-trophy"></i>';
          break;
      case 20:
          echo '<i title="Training" class="fa fa-graduation-cap"></i>';
          break;
    }
  }
 /**
  * Stores this event
  * @return Mixed If successful returns id of new event if not false
  */
  public function store(){
    Flight::db()->begin_transaction();

    $sql = "INSERT INTO events (type, team, title, text, start, end) VALUES ('$this->type','$this->team','$this->title','$this->text','$this->start','$this->end')";

    $result = Flight::db()->query($sql);

    if($result == false){
      Flight::db()->rollback();
      return false;
    }
    $id = Flight::db()->insert_id;
    Flight::db()->commit();
    return $id;
  }

  public function delete(){
    Flight::db()->begin_transaction();

    $sql = "DELETE FROM events WHERE id = '$this->id'";

    $result = Flight::db()->query($sql);
    if($result == false){
      Flight::db()->rollback();
      return false;
    }
    Flight::db()->commit();
    return true;
  }
}
