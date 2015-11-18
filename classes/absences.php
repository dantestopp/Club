<?php

class absence{
    
  public $id;
  public $reason;
  public $player;
  public $start;
  public $end;

  function __construct($arr){
    $this->id = $arr['id'];
    $this->reason = $arr['reason'];
    $this->player = $arr['player'];
    $this->start = $arr['start'];
    $this->end = $arr['end'];
  }

  /**
   * Get Icon from absence
   * @return String Icon
   */
  public function getIcon(){

    switch($this->reason){
      //Injury
      case 10: return '<i title="Injury" class="fa fa-medkit"></i>';
      //Ill
      case 20: return '<i title="Ill" class="fa fa-meh-o"></i>';
      //Unknown
      case 30: return '<i title="Unknown" class="fa fa-question"></i>';
    }
  }

  /**
   * Store this absence
   * @return Boolean If successful returns true if not false
   */
  public function store(){
    Flight::db()->begin_transaction();

    $sql = "INSERT INTO absences (player, `start`, `end`, reason) VALUES ('$this->player','$this->start','$this->end','$this->reason')";

    $result = Flight::db()->query($sql);
    if($result == false){
      Flight::db()->rollback();
      return false;
    }
    Flight::db()->commit();
    return true;
  }
  /**
   * Delete this absence
   */
  public function delete(){
    Flight::db()->begin_transaction();

    $sql = "DELETE FROM absences WHERE id = '$this->id'";

    $result = Flight::db()->query($sql);
    if($result == false){
      Flight::db()->rollback();
      return false;
    }
    Flight::db()->commit();
    return true;
  }
}
