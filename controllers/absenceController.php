<?php

class absenceController{

  public function getAbsenceWithId($id){
    $sql = "SELECT * FROM absences WHERE id = '$id'";
    $result = Flight::db()->query($sql);
    return new absence($result->fetch_assoc());
  }

  public function showNewAbsence($team,$event){
    if($event != null){
      $event = Flight::events()->getEventWithId($event);
    }
    $team = Flight::teams()->getTeamWithId($team);
    Flight::util()->render('newAbsence',array('team'=>$team,'event'=>$event));
  }

  public function saveNewAbsence($team, $event){
    Flight::auth()->check();
    $absence = new absence(Flight::request()->data);
    $absence->store();
    if(isset($event)){
      Flight::redirect("/event/".$event);
    }else{
      Flight::redirect("/team/".$team);
    }
  }

  public function deleteAbsence($id){
    Flight::auth()->check();
    $absence = Flight::absence()->getAbsenceWithId($id);
    $absence->delete();
    Flight::redirect(Flight::request()->referrer);
  }
}
