<?php
abstract class UNL_Annotate_LoginRequired
{
    public $options = array();
    
    final function __construct($options = array())
    {
        $this->options = $options + $this->options;
        UNL_Annotate::authenticate();
        $this->__postConstruct();
    }
}