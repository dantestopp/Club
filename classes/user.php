<?php

class user{
  public $id;
  public $surname;
  public $forename;
  public $email;
  private $password;
  public $role = 10;
  public $teams = array();

  public static $validate = array(
    "surname" => array(
                      "type"=>"text",
                      "required"=>true),
    "forename" => array(
                      "type"=>"text",
                      "required"=>true),
    "email" => array(
                      "type"=>"email",
                      "required"=>true,
                      "unique"=>true),
    "role" => array(
                      "type"=>"int",
                      "required"=>true
                                        )
  );

  function __construct($arr){
    $this->id = $arr['id'];
    $this->surname = $arr['surname'];
    $this->forename = $arr['forename'];
    $this->email = $arr['email'];
    $this->role = $arr['role'];
  }

  public function getTeams(){
    if($this->role == 20){
      $this->teams =  Flight::teams()->getAllTeams();
      return $this->teams;
    }
    $sql = "SELECT team.* FROM team, coach_team WHERE team.id = coach_team.team_id AND coach_team.coach_id = '$this->id'";

    $result = Flight::db()->query($sql);
    $this->teams = array();
    if($result == false){
      return $this->teams;
    }else{
      while($row = $result->fetch_assoc()){
        $this->teams[] = new team($row);
      }
      return $this->teams;
    }


  }

  public function store(){
      Flight::db()->begin_transaction();
      $password = password_hash("test",PASSWORD_DEFAULT);
      $sql = "INSERT INTO user(surname,forename,email,password,role) VALUES('$this->surname','$this->forename','$this->email','$password','$this->role')";
      $result = Flight::db()->query($sql);

      if(count($this->teams)>0){
        $coach_id = Flight::db()->insert_id;
        foreach($this->teams as $team_id){
          $sql = "INSERT INTO coach_team(coach_id, team_id) VALUES ($coach_id,$team_id)";
          Flight::db()->query($sql);
        }
      }
      Flight::db()->commit();
  }

  public function update(){
    Flight::db()->begin_transaction();
    $sql = "UPDATE user SET surname = '$this->surname', forename = '$this->forename', email = '$this->email' WHERE id='$this->id'";

    $result = Flight::db()->query($sql);

    if($result == false){
      Flight::db()->rollback();
      return false;
    }

    $sql = "SELECT * FROM coach_team WHERE coach_id = '$this->id'";
    $result = Flight::db()->query($sql);

    if($result == false){
      Flight::db()->rollback();
      return false;
    }
    if($this->role == 20){
      Flight::db()->commit();
      return true;
    }
    $ids = array();
    while($row = $result->fetch_assoc()){
      $ids[] = $row['team_id'];
    }

    $new = array_diff($this->teams,$ids);
    $removed = array_diff($ids,$this->teams);
    foreach($new as $id){
      $sql = "INSERT INTO coach_team (team_id, coach_id) VALUES ('$id','$this->id')";
      Flight::db()->query($sql);
    }

    foreach($removed as $id){
      $sql = "DELETE FROM coach_team WHERE team_id = '$id' AND coach_id = '$this->id'";
      Flight::db()->query($sql);
    }

    Flight::db()->commit();
    
    return true;
  }
}
