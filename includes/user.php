<?php
require_once('database.php');
    
class User{

    
    public static function find_all(){
        self::find_by_sql("SELECT * FROM users");
    }
    
    public static function find_by_id($id=0){
        global $database;
        $result_set = self::find_by_sql("SELECT * FROM users WHERE id={$id} LIMIT 1");
        $found = $database->fetch_array($result_set);
        return $found;
        
    } 
    
    public static function find_by_sql($sql=""){
        global $database;
        $result_set = $database->query($sql);
        return $result_set;
    }
    
}

?>