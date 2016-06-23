<?php
require_once('initialize.php');
    
class Photograph extends DatabaseObject {
    
    protected static $table_name="photographs";
    protected static $db_fields = ['filename','type','size','caption'];
    
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
        UPLOAD_ERR_EXTENSION => "file upload sotpped by extension"
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
            $this->filename = basename($file['name']); //basename houdt enkel het laatste deel van de path over
            $this->type = $file['type'];
            $this->size = $file['size'];    
            return true;
        }
    }
    
    public function save() {
        //check for write or update
        if(isset($this->id)) {
            echo "SENDING UPDATE";
            $this->update();
        } else{
            //error check, lijst moet leeg zijn
            if(!empty($this->errors)) { return false; }
            //caption string length check
            if(strlen($this->caption) > 255) {
                $this->errors[] = "The caption can only be 255 characters long";
                return false;
            }
            //check bestand
            if(empty($this->filename) || empty($this->temp_path)) {
                $this->errors[] = "The files location is not available";
                return false;
            }
            //Bestemming
            $target_path = SITE_ROOT .DS. 'public' .DS. $this->upload_dir .DS. $this->filename;
            
            //Check duplicaat
            if(file_exists($target_path)) {
                $this->errors[] = "The file {$this->filename} already exists";
                return false;
            }
            
            //Bestand overzetten van temp naar bestemming
            if(move_uploaded_file($this->temp_path,$target_path)) {
                if($this->create()) {
                    unset($this->temp_path);
                    return true;
                }
                
            } else {
                $this->errors[] = "File upload failed. Check write permissions";
                return false;
            }

        }
    }
    
    public function find_all() {
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
     
    /* ------------------------------
    Veelvoorkomende DB methodes
    Later migreren
     -------------------------------*/
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
        $clean_array = [];
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