<?php

class eventController{

  public function getEventWithId($id){
    $sql = "SELECT * FROM events WHERE id = '$id'";
    $result = Flight::db()->query($sql);
    return new event($result->fetch_assoc());
  }

  public function showEvent($id){
    Flight::auth()->check();
    $event = Flight::events()->getEventWithId($id);
    $team = Flight::teams()->getTeamWithId($event->team);
    Flight::util()->render('event', array("event"=>$event,"team"=>$team));
  }

  public function showNewEvent($team_id){
    Flight::auth()->check();
    Flight::util()->render('newEvent',array('team_id'=>$team_id));
  }

  public function saveNewEvent(){
    Flight::auth()->check();
    $response = Flight::util()->validate('event', Flight::request()->data);
    if(is_array($response)){
        Flight::util()->render('newEvent',array('team_id'=>Flight::request()->data->team,'error'=>$response));
        return;
    }
    $event = new event(Flight::request()->data);
    $id = $event->store();

    Flight::redirect('/event/'.$id);
  }

  public function deleteEvent($id){
    Flight::auth()->check();
    $event = Flight::events()->getEventWithId($id);
    $team_id = $event->team;
    $event->delete();
    Flight::redirect("/team/".$team_id);
  }
}
