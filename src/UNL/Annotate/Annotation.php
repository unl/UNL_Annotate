<?php
class UNL_Annotate_Annotation extends UNL_Annotate_Record
{
    public $fieldname;
    
    public $sitekey;
    
    public $user_id;
    
    public $note;
    
    public $modified;

    function __construct($options = array())
    {
        if(isset($options['sitekey']) && isset($options['fieldname'])) {
            $this->fieldname = $options['fieldname'];
            $this->sitekey = $options['sitekey'];
            if ($user = UNL_Annotate::getUser()) {
                $this->user_id = $user->id;
            }
            if (!$this->note = self::getNote($this->fieldname,$this->sitekey,$this->user_id)) {
                //Don't do 404, display empty note to edit instead?
                //throw new Exception('Note doesn not exist', 404);
            }
        }
    }

    function save($type)
    {
        if (!UNL_Annotate_Site::validRequest($this->sitekey)) {
            throw new Exception('Unregistered site key');
        }

        switch ($type) {
            case 'insert' :
                $result = parent::insert();
            case 'update' :
                $result = parent::update();
            default :
                $result = parent::save();
        }

        if (!$result) {
            throw new Exception('Error saving annotation', 500);
        }

        echo 'success';
        exit();
    }

    function getNote($fieldname, $sitekey, $user_id)
    {
        $mysqli = UNL_Annotate::getDB();
        $sql = 'SELECT note FROM annotations WHERE fieldname = "'.$mysqli->escape_string($fieldname).'" ';
        $sql .= 'AND sitekey = "'.$mysqli->escape_string($sitekey).'" ';
        $sql .= 'AND user_id = "'.intval($user_id).'" LIMIT 1;';
        if ($result = $mysqli->query($sql)) {
            if ($row = $result->fetch_array(MYSQLI_NUM)) {
                return $row[0];
            }
        }
        return false;
    }

    public static function getTable()
    {
        return 'annotations';
    }

    function keys()
    {
        return array('user_id', 'sitekey', 'fieldname');
    }
}