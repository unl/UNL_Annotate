<?php
class UNL_Annotate_Site extends UNL_Annotate_Record
{
    public $sitekey;

    public $address;
    
    public static function validRequest($key)
    {
        $site = self::getByKey($key);
        if ($site) {
            return true;
        }
        return false;
    }
    
    public static function getByKey($key)
    {
        if ($record = UNL_Annotate_Record::getRecordByValue('sites', $key, 'sitekey')) {
            $object = new self();
            UNL_Annotate::setObjectFromArray($object, $record);
            return $object;
        }
        return false;
    }
}