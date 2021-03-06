<?php

class Session{
    
    private $logged_in = false;
    public $user_id;
    public $message;
    
    function __construct(){
        session_start();
        $this->check_message();
        $this->check_login();
        if($this->logged_in){
            // actions if users are logged in
        } else {
            //actions if user not logged in
        }
    }
    
    public function is_logged_in() {
        return $this->logged_in;
    }
    
    public function login($user){
        //database should find user based on username/password
        if($user) {
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->logged_in = true;
        }
    }
    
    public function logout() {
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->logged_in = false;
    }
    
    private function check_login()
    {
        if(isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->logged_in = true;
        } else {
            unset($this->user_id);
            $this->logged_in = false;
        }
    }
    
    public function check_message() 
    {
        if(isset($_SESSION['message']))
        {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }

    public function message($msg="") {
        if(!empty($msg)) {
            $_SESSION['message'] = $msg;
        } else {
            return $this->message;
        }
    }
}



$session = new Session();
$message = $session->message();

?>
