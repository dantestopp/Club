<?php

class userController{

  public function getUserWithId($id){
    $sql = "SELECT * FROM user WHERE id = '$id'";
    $result = Flight::db()->query($sql);
    return new user($result->fetch_assoc());
  }

  public function saveUserSettings(){
    Flight::auth()->check();
    if(Flight::request()->data->id != Flight::auth()->currentUser->id){
      Flight::auth()->check(20);
    }

    $user = Flight::users()->getUserWithId(Flight::request()->data->id);

    $response = Flight::util()->validate('user',Flight::request()->data, true);
    if(is_array($response)){
      Flight::util()->render('editUser',array("teams"=>Flight::teams()->getAllTeams(),"user"=>$user,"error"=>$response));
      return;
    }

    $user = new user(Flight::request()->data);
    $user->teams = Flight::request()->data->teams;
    if($user->update()){
      Flight::util()->render('editUser',array("teams"=>Flight::teams()->getAllTeams(),"user"=>$user,"flash"=>array("word"=>"User","action"=>"updated")));
    }
  }

  public function showUserSettings($id){
    if($id == null){
        Flight::auth()->check();
        $user = Flight::auth()->currentUser;
    }else{
        Flight::auth()->check(20);
        $user = Flight::users()->getUserWithId($id);
    }
    Flight::util()->render('editUser',array("teams"=>Flight::teams()->getAllTeams(),"user"=>$user));
  }

  public function showNewUser(){
    Flight::auth()->check(20);
    Flight::util()->render('newUser',array("teams"=>Flight::teams()->getAllTeams()));
  }
}
