<?php
class UNL_Annotate_Site extends UNL_Annotate_Record
{
    public $sitekey;

    public $domain;
    
    public static function validRequest($key, $referrer)
    {
        $site = self::getByKey($key);
        if ($site->domain == $referrer) {
            return true;
        }
        return false;
    }
    
    public static function getByKey($key)
    {
        if ($record = UNL_Announce_Record::getRecordByID('sites', $key, 'key')) {
            $object = new self();
            UNL_Annotate::setObjectFromArray($object, $record);
            return $object;
        }
        return false;
    }
}