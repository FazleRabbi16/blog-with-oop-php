<?php
//Session class
class Session{
//start session
public static function int(){
	session_start();
} 	
 //set login value in session.	
 public static function set($key,$value){
   $_SESSION[$key] = $value;
 }

//get login value with session
public static function get($key){
	if(isset($_SESSION[$key])){
         return $_SESSION[$key];
	}else{
		return false;
	}
}

//check session.if geting user not login then redirect login page
public  static function checksession(){
	self::int();
	if(self::get('login')==false){
       self::destroy();
       header('location:login.php');
	}
}

public  static function checklogin(){
	if(self::get('login')==true){
       header('location:index.php');
	}
}


//destroy session for logout
public static function destroy(){
	 session_destroy();
	 session_unset();
	 header("location:login.php");
}

 }
	 

