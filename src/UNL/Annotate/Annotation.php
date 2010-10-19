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
        
    }

    function save()
    {
        if (!UNL_Annotate_Site::validRequest($this->sitekey)) {
            throw new Exception('Unregistered site key');
        }
        
        $result = parent::save();
        
        if (!$result) {
            throw new Exception('Error saving annotation', 500);
        }
        
        echo 'success';
        exit();
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