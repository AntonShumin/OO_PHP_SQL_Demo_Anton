<?php
require_once('database.php');
    
class Photograph extends DatabaseObject {
    
    protected static $table_name="photographs";
    protected static $db_fields = ['id','filename','type','size','caption'];
    
    public $id;
    public $filename;
    public $type;
    public $size;
    public $caption;
    
    
    private $temp_path;
    protected $upload_dir="images";
    public $errors=array(); //loggen van fouten
    
    //beschrijving http://php.net/manual/en/features.file-upload.errors.php
    protected $upload_errors = [
        UPLOAD_ERR_OK => "No errors",
        UPLOAD_ERR_INI_SIZE => "Larger than upload_max_filesize",
        UPLOAD_ERR_FORM_SIZE =>"Larger than form MAX_FILE_SIZE",
        UPLOAD_ERR_PARTIAL => "Partial upload",
        UPLOAD_ERR_NO_FILE => "No file",
        UPLOAD_ERR_NO_TMP_DIR => "No temporar directory",
        UPLOAD_ERR_CANT_WRITE => "Can't write to disk",
        UPLOAD_ERR_EXTENSION = > "file upload sotpped by extension"
    ];
    
    public function attach_file($file) {
        // Error checkdate
        if(!$file || empty($file) || !is_array($file)) {
            $this->errors[] = "No file was uploaded";
            return false;
        } elseif ($file['error'] != 0 ) {
            $this->errors[] = $this->upload_errors[$file['error']];
            return false;
        } else {
            $this->temp_path = $file['tmp_name'];
            $this->filename = basename($file['name']); //basename houdt de laatste deel over van de path
            $this->type = $file['type'];
            $this->size = $file['size'];    
            return true;
        }
    }
    
    public function save() {
        if(isset($this->id)) {
            $this->update();
        } else{
            //error check
            if(!empty($this->errors)) { return false; }
            $this->create();
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
     
    /* ------------------------------
    Veelvoorkomende DB methodes
    Later migreren
    */ -------------------------------
    rotected function attributes() {
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
    /*
    public function save() { 
        return $this->create();
    }
    */
    
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
        foreach($attribute as $key => $value) {
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