<?php
/**
 * Format
 */
class Format{

	//format date time
  public function dateformat($date){
  	return  date('l jS \of F Y  g:i a',strtotime($date));
  }

//format post text
  public function textshort($text,$limit=400){
    $text = $text." ";
  	$text = substr($text,0,$limit);
  	$text = substr($text,0,strrpos($text,' '));
  	$text = $text."......";
  	return $text;
  }

//Remove insect character from input data
  public function filterdata($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

//format header title 
public function title(){
  $path = $_SERVER['SCRIPT_FILENAME'];
  $title = basename($path,'.php');
  if ($title=='index'){
    $title = 'Home';
  }elseif ($title == 'contact'){
      $title ='contact';
  }
return $title = ucwords($title);
} 


}

?>