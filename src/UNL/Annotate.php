<?php
class UNL_Annotate
{
    public $options = array('format' => 'json',
                            'view'   => 'annotation');

    public $view_annotation = array('annotation'       => 'UNL_Annotate_Annotation',
                             );

    public static $url;

    protected static $auth;

    protected static $user = false;

    public static $db_user = 'SETINCONFIG';

    public static $db_pass = 'SETINCONFIG';

    public $actionable = array();

    function __construct($options = array())
    {
        $this->options = $options + $this->options;
        $this->authenticate(true);

        try {
            if (!empty($_POST)) {
                $this->handlePost();
            }
            $this->run();
        } catch(Exception $e) {
            if (false == headers_sent()
                && $code = $e->getCode()) {
                header('HTTP/1.1 '.$code.' '.$e->getMessage());
                header('Status: '.$code.' '.$e->getMessage());
            }

            $this->actionable[] = $e;
        }
    }

    function run()
    {
         if (isset($this->view_map[$this->options['view']])) {
             $this->actionable[] = new $this->view_map[$this->options['view']]($this->options);
         } else {
             throw new Exception('Un-registered view');
         }
    }

    /**
     * Handle data that is POST'ed to the controller.
     * 
     * @return void
     */
    function handlePost()
    {
        $annotation = UNL_Annotate_Annotation::edit($_POST);
    }

    /**
     * Get the URL to the main site.
     * 
     * @return string The URL to the site
     */
    public static function getURL()
    {
        return self::$url;
    }

    /**
     * Set the public properties for an object with the values in an associative array
     * 
     * @param mixed &$object The object to set, usually a UNL_Annotate_Record
     * @param array $values  Associtive array of key=>value
     * @throws Exception
     * 
     * @return void
     */
    public static function setObjectFromArray(&$object, $values)
    {
        if (!isset($object)) {
            throw new Exception('No object passed!');
        }
        foreach (get_object_vars($object) as $key=>$default_value) {
            if (isset($values[$key]) && (!is_null($values[$key]))) {
                $object->$key = $values[$key]; 
            }
        }
    }

    /**
     * Log in the current user
     * 
     * @return void
     */
    static function authenticate($logoutonly = false)
    {
        if (isset($_GET['logout'])) {
            self::$auth = UNL_Auth::factory('SimpleCAS');
            self::$auth->logout();
        }
        if ($logoutonly) {
            return true;
        }

        self::$auth = UNL_Auth::factory('SimpleCAS');
        self::$auth->login();

        if (!self::$auth->isLoggedIn()) {
            throw new Exception('You must log in to view this resource!');
            exit();
        }
        self::$user = UNL_Annotate_User::getByUID(self::$auth->getUser());
        self::$user->last_login = date('Y-m-d H:i:s');
        self::$user->update();
    }
}