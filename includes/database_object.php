<?php
require_once("database.php");

class DatabaseObject{
    
    //Common DB methodes
    public static function find_all(){
        return static::find_by_sql("SELECT * FROM " . static::$table_name);
    }
    public static function find_by_id($id=0){
        $result_array = static::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE id={$id} LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
        
    } 
    public static function find_by_sql($sql=""){
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while($row = $database->fetch_array($result_set)){
            $object_array[] = static::instantiate($row);
        }
        return $object_array;
    }
    private static function instantiate($record){
        $object = new static;
        foreach($record as $attribute=>$value){
            if($object->has_attribute($attribute)){
                $object->$attribute = $value;
            }
        }
        
        return $object;
    }  
    private function has_attribute($attribute){
        $object_vars = $this->attributes();
        return array_key_exists($attribute,$object_vars);
    }
}
?>