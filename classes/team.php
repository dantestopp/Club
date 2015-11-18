<?php

class team{
  public $id;
  public $name;

  public static $validate = array(
    "name"=>array(
      "type"=>"text",
      "required"=>true,
      "unique"=>true
    )
  );
  function __construct($arr){
    $this->id = $arr['id'];
    $this->name = $arr['name'];
  }

  public function getPlayers(){

    $sql = "SELECT player.* FROM player WHERE team = '$this->id'";

    $result = Flight::db()->query($sql);

    $players = array();

    while($row = $result->fetch_assoc()){
      $players[] = new player($row);
    }

    return $players;
  }

  public function getCoaches(){

        $sql = "SELECT user.* FROM user, coach_team WHERE user.id = coach_team.coach_id AND coach_team.team_id = '$this->id'";
        $result = Flight::db()->query($sql);

        $coaches = array();

        while($row = $result->fetch_assoc()){
          $coaches[] = new user($row);
        }

        return $coaches;
  }

  public function getAbsences(){

    $sql = "SELECT * FROM `absences`, player WHERE absences.player = player.id AND player.team = '$this->id' AND end > NOW()";
    $result = Flight::db()->query($sql);
    $absences = array();
    while($row = $result->fetch_assoc()){
      $absences[] = new absence($row);
    }

    return $absences;
  }

  public function getAbsencesInTimerange($from, $to){

    $sql = "SELECT DISTINCT absences.* FROM `absences`, player WHERE absences.player = player.id AND player.team = '$this->id' AND (((end BETWEEN '$from' AND '$to') AND (start BETWEEN '$from' AND '$to')) OR (end > '$to' AND start < '$from'))";
    $result = Flight::db()->query($sql);
    $absences = array();
    while($row = $result->fetch_assoc()){
      $absences[] = new absence($row);
    }

    return $absences;
  }

  public function getReadyPlayersInTimerange($ids=[]){

    $ids = implode(",", $ids);
    $sql = "SELECT player.* FROM player WHERE player.id AND player.team = '$this->id' AND player.id NOT IN('$ids')";
    $result = Flight::db()->query($sql);
    $player = array();
    while($row = $result->fetch_assoc()){
      $player[] = new player($row);
    }

    return $player;
  }

  public function getEvents(){

    $sql = "SELECT * FROM events WHERE team = '$this->id' AND `end` > NOW()";
    $result = Flight::db()->query($sql);

    $events = array();

    while($row = $result->fetch_assoc()){
      $events[] = new event($row);
    }

    return $events;
  }

  public function store(){

        Flight::db()->begin_transaction();
        $sql = "INSERT INTO team (name) VALUES ('$this->name')";
        Flight::db()->query($sql);
        $last_id = Flight::db()->insert_id;
        Flight::db()->commit();

        return $last_id;

  }

    public function delete(){

        Flight::db()->begin_transaction();
        $players = $this->getPlayers();
        foreach($players as $player){
          $player->team = '0';
          $player->update();
        }
        $sql = "DELETE FROM coach_team WHERE team_id = '$this->id'";
        $response = Flight::db()->query($sql);
        if($response == false){
          Flight::db()->rollback();
          return false;
        }

        $sql = "DELETE FROM events WHERE team = '$this->id'";
        $response = Flight::db()->query($sql);
        if($response == false){
          Flight::db()->rollback();
          return false;
        }

        $sql = "DELETE FROM team WHERE id = '$this->id'";
        Flight::db()->query($sql);
        if($response == false){
          Flight::db()->rollback();
          return false;
        }
        Flight::db()->commit();
        return true;
  }
}
