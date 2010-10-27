<?php
class UNL_Annotate_PopUpLogin
{
    function __construct()
    {
        if (!UNL_Annotate::getUser()) {
            $_GET['login'] = true;
            UNL_Annotate::authenticate();
        }
    }
}