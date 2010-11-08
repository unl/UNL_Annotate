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
            if (!UNL_Annotate_Site::validRequest($options['sitekey'])) {
                throw new Exception('Unregistered site key', 400);
            }
            $this->fieldname = $options['fieldname'];
            $this->sitekey = $options['sitekey'];

            if (!$this->note = self::getNote($this->fieldname,$this->sitekey)) {
                //Don't do 404, display empty note to edit instead?
                //throw new Exception('Note doesn not exist', 404);
            }
        } else {
            throw new Exception('Missing API Keys', 400);
        }
    }

    function save($type)
    {
        if (!UNL_Annotate_Site::validRequest($this->sitekey)) {
            throw new Exception('Unregistered site key', 400);
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

    public static function getNote($fieldname, $sitekey, $user_id = null)
    {
        if (null === $user_id) {
            if ($user = UNL_Annotate::getUser()) {
                $user_id = $user->id;
            } else {
                return false;
            }
        }
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