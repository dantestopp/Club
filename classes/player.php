<?php

class player{
  public $id;
  public $surname;
  public $forename;
  public $email;
  public $phone_mobile;
  public $phone_home;
  public $team;

  public static $validate = array(
    "surname" => array(
                      "type"=>"text",
                      "required"=>true),
    "forename" => array(
                      "type"=>"text",
                      "required"=>true),
    "email" => array(
                      "type"=>"email",
                      "required"=>true),
    "phone_mobile" => array(
                      "type"=>"phone",
                      "required"=>false),
    "phone_home" => array(
                      "type"=>"phone",
                      "required"=>false),
    "team" => array(
                      "type"=>"int",
                      "required"=>true
                                        )
  );

  function __construct($arr){
    $this->id = $arr['id'];
    $this->surname = $arr['surname'];
    $this->forename = $arr['forename'];
    $this->email = $arr['email'];
    $this->phone_mobile = $arr['phone_mobile'];
    $this->phone_home = $arr['phone_home'];
    $this->team = $arr['team'];
  }

  public function getAbsences(){
    $sql = "SELECT * FROM `absences` WHERE player = $this->id AND end > NOW()";
    $result = Flight::db()->query($sql);
    $absences = array();
    while($row = $result->fetch_assoc()){
      $absences[] = new absence($row);
    }
    return $absences;
  }

  public function store(){
      Flight::db()->begin_transaction();

      $sql = "INSERT INTO player (surname, forename, email, phone_mobile, phone_home, team) VALUES ('$this->surname','$this->forename','$this->email','$this->phone_mobile','$this->phone_home','$this->team')";

      $result = Flight::db()->query($sql);
      if($result == false){
        Flight::db()->rollback();
        return false;
      }
      Flight::db()->commit();
      return true;
  }
  public function update(){
    Flight::db()->begin_transaction();

    $sql = "UPDATE player SET surname = '$this->surname', forename = '$this->forename', email = '$this->email', phone_mobile = '$this->phone_mobile', phone_home = '$this->phone_home', team = '$this->team' WHERE id = '$this->id'";

    $result = Flight::db()->query($sql);
    if($result == false){
      Flight::db()->rollback();
      return false;
    }
    Flight::db()->commit();
    return true;
  }

  public function delete(){
    Flight::db()->begin_transaction();

    $sql = "DELETE FROM player WHERE id = '$this->id'";

    $result = Flight::db()->query($sql);
    if($result == false){
      Flight::db()->rollback();
      return false;
    }
    Flight::db()->commit();
    return true;
  }

}
