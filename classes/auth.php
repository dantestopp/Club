<?php

class auth{
  public $logedin = false;
  public $currentUser = null;

  public static $validate = array(
    "email"=>array(
                "type"=>"email",
                "required"=>true),
    "password"=>array(
                "type"=>"password",
                "required"=>true
                    )
  );
  public function check($role = 10){
    if(!isset($_SESSION['user'])){
      Flight::notLogedIn();
    }

    $this->currentUser = $_SESSION['user'];

    if($this->currentUser->role < $role){
      Flight::noAccess();
    }else{
      $this->logedin = true;
    }

  }

  public function online(){
    return !($this->currentUser==null);
  }

  function __construct(){
    $this->currentUser =  isset($_SESSION['user'])?$_SESSION['user']:null;
  }

  public function logout(){
    unset($_SESSION['user']);
    Flight::redirect("/");
  }

  public function login(){
      $response = Flight::util()->validate("auth",Flight::request()->data);
      if(is_array($response)){
      Flight::util()->render('login',array('error'=>$response));
      return;
      }
      $email = Flight::request()->data->email;
      $password = Flight::request()->data->password;

      $sql = "SELECT * FROM user WHERE email = '$email'";

      $result =  Flight::db()->query($sql);

      if($result == false){
        Flight::util()->render('login',array('error_string'=>true));
        return;
      }

      $row = $result->fetch_assoc();

      if(password_verify($password, $row['password'])){
          $_SESSION['user'] = new user($row);
          Flight::redirect('/teams');
      }else{
        Flight::util()->render('login',array('error_string'=>true));
        return;
      }

  }

  public function register(){
    Flight::auth()->check(20);

    $response = Flight::util()->validate("user",Flight::request()->data);
    if(is_array($response)){
      Flight::util()->render('newUser',array('error'=>$response,"teams"=>Flight::teams()->getAllTeams()));
      return;
    }
    $data = Flight::request()->data;

    $user = new user($data);
    $user->teams = Flight::request()->data->teams;
    $user->store();
    Flight::redirect("/createUser");
  }



}
