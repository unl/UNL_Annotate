<?php
class UNL_Annotate_User extends UNL_Annotate_Record
{
    public $id;

    public $uid;

    public $lastlogin;

    function __construct($options = array())
    {
        if (isset($options['uid'])) {
            $mysqli = UNL_Annotate::getDB();
            $sql = "SELECT * FROM users WHERE uid = '".$mysqli->escape_string($options['uid'])."';";
            if (($result = $mysqli->query($sql))
                && $result->num_rows > 0) {
                UNL_Annotate::setObjectFromArray($this, $result->fetch_assoc());
            }
        }
    }

    public static function getByUID($uid)
    {
        $mysqli = UNL_Annotate::getDB();
        $sql = "SELECT * FROM users WHERE uid = '".$mysqli->escape_string($uid)."';";
        if (($result = $mysqli->query($sql))
            && $result->num_rows > 0) {
            $object = new self();
            UNL_Annotate::setObjectFromArray($object, $result->fetch_assoc());
            return $object;
        }

        $object = new self();
        $object->uid = $uid;
        $object->insert();
        return $object;
    }

    public static function getID()
    {
        return $this->id;
    }

    public static function getTable()
    {
        return 'users';
    }
}