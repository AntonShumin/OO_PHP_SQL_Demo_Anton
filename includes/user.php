<?php
require_once('initialize.php');

    
class User extends DatabaseObject {

    protected static $table_name="users";
    protected static $db_fields =['id','username','password','first_name','last_name'];
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /* ------------------------------
        Veelvoorkomende DB methodes
        Later migreren
    -------------------------------*/ 
    public function full_name() {
        if(isset($this->first_name) && isset($this->last_name) ){
            return $this->first_name . " " . $this->last_name ;
        } else {
            return "";
        }
    }
    
    public static function authenticate($username="",$password="") {
        global $database;
        $username = $database->escape_value($username);
        $password = $database->escape_value($password);
        
        $sql = "SELECT * FROM ".self::$table_name;
        $sql .= " WHERE username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";
        $result_array = self::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : false;
    }
    
    //CRUD
    
    public function save() { 
        return $this->create();
    }
    
    
    protected function attributes() {
        $attributes = [];
        foreach(self::$db_fields as $field){
            if(property_exists($this,$field)){
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }
    
    protected function clean_attributes() {
        global $database;
        $clean_array = array();
        foreach($this->attributes() as $key =>$value) {
            $clean_array[$key] = $database->escape_value($value);
        }
        return $clean_array;
    }
    
    protected function create(){
        global $database;
        $attributes = $this->clean_attributes();
        $sql = "INSERT INTO ".self::$table_name." (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";
        if($database->query($sql)) {
            $this->id = $database->insert_id();
            return true;    
        } else {
            return false;
        }
    }
    
    protected function update() {
        global $database;
        $attributes = $this->clean_attributes();
        $attribute_pairs = array();
        foreach($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE ".self::$table_name." SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE id=" . $database->escape_value($this->id);
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }
    
    public function delete() {
        global $database;
        $sql = "DELETE FROM ".self::$table_name;
        $sql .= " WHERE id=" . $database->escape_value($this->id);
        $sql .= " LIMIT 1";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }
    
}

?>