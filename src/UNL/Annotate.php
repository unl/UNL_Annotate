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

    public static $db_name = 'unl_annotate';

    public $actionable = array();

    function __construct($options = array())
    {
        $this->options = $options + $this->options;
        $this->authenticate();

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
         if (!isset($this->view_map[$this->options['view']])) {
             throw new Exception('Un-registered view', 404);
         }

         $this->actionable[] = new $this->view_map[$this->options['view']]($this->options);
    }

    /**
     * Handle data that is POST'ed to the controller.
     * 
     * @return void
     */
    function handlePost()
    {
        $annotation = new UNL_Annotate_Annotation();
        
        $_POST['user_id'] = UNL_Annotate::getUser()->id;
        
        self::setObjectFromArray($annotation, $_POST);
        
        if (!$annotation->save()) {
            throw new Exception('Could not save the annotation');
        }
    }

    /**
     * Connect to the database and return it
     * 
     * @return mysqli
     */
    public static function getDB()
    {
        $db = new mysqli('127.0.0.1', self::$db_user, self::$db_pass, self::$db_name);
        if (mysqli_connect_error()) {
            throw new Exception('Database connection error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
        $db->set_charset('utf8');
        return $db;
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
    static function authenticate()
    {
        self::$auth = UNL_Auth::factory('SimpleCAS');

        if (isset($_GET['logout'])) {
            self::$auth->logout();
        }

        self::$auth->login();

        if (!self::$auth->isLoggedIn()) {
            throw new Exception('You must be logged in to use this resource');
            exit();
        }

        self::$user = UNL_Annotate_User::getByUID(self::$auth->getUser());
        //Update lastlogin timestamp
        self::$user->update();
    }

    /**
     * Get the currently logged in user
     * 
     * @return UNL_Annotate_User
     */
    public static function getUser($forceAuth = false)
    {
        if (self::$user) {
            return self::$user;
        }

        if ($forceAuth) {
            self::authenticate();
        }

        return self::$user;
    }
}