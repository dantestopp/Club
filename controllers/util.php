<?php

class util{

    public function render($viewname, $args=array()){
        Flight::render($viewname.".php",$args,'body_content');
        Flight::render('layout');
    }

    public function success($word, $action = 'created'){
        echo '<div class="alert alert-success" role="alert">'.$word.' '.$action.' successful</div>';
    }

    public function error($arg){
        echo '<div class="alert alert-danger" role="alert">Input '.$arg['name'].' is '.$arg['type'].'</div>';
    }

    public function validate($model, $inputs, $update = false){

      $rules = $model::$validate;
      $error = false;
      $response = array();
      foreach($inputs as $key => $input){
          if(array_key_exists($key,$rules)){
            $rule = $rules[$key];
            $response[$key] = array("value"=>$input, "name"=>$key);
            if(empty($input)&&$rule['required']==true){
              $response[$key]['type'] = "missing";
              $error = true;
              continue;
            }
            if(isset($rule['unique']) && $rule['unique']==true && $update == false){

              $sql = "SELECT * FROM $model WHERE $key = '$input'";
              $result = Flight::db()->query($sql);
              if($result->num_rows > 0){
                $response[$key]['type'] = 'not unique';
                $error = true;
                continue;
              }
            }
            $response[$key] = array("value"=>$input, "name"=>$key);
            switch($rule['type']){
              case "email": if(!filter_var($input,FILTER_VALIDATE_EMAIL)){$response[$key]['type'] = "invalid";$error = true;}break;
              case "int": if(!filter_var($input,FILTER_VALIDATE_INT)){$response[$key]['type'] = "invalid";$error = true;}break;
              case "text": if(!preg_match('/^[A-Za-z]+$/',$input)){$response[$key]['type'] = "invalid";$error = true;}break;
            }
          }
      }
      
      return $error == true?$response:true;
    }
}
