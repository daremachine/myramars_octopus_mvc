<?php declare(strict_types=1);

class AppConfig
{
    /** PROJECT SETUP  [MUST HAVE]  ****************************/

    /**
     * @param string DOCUMENT_ROOT
     */
    public static $DOCUMENT_ROOT = '/projects/myramars_octopus_mvc/';

    /**
     * @param string Domain
     */
    public static $DOMAIN = '';



    /** DEBUG TOOLS  ****************************/
    
    /**
     * @param bool Debug loaded files
     */
    public static $LOADER_DEBUG = false;



    /** ALPHA-CLOSED  ****************************/

    /**
     * @param bool Alpha closed login page password
     */
    public static $ALPHA_CLOSED_LOGIN_PASSWORD = "xa";

    /**
     * @param bool Use Alpha closed test [putenv => "USEALPHACLOSED=true"]
     */
    public static $USE_ALPHA_CLOSED_TEST = false;


    
    /** SITE PROPERTIES  ****************************/
    
    /**
     * Web Application
     */
    public static $LOCATION = "Praha";
    public static $PHONE = "+420 777 808 718";
    public static $EMAIL = "info@softrio.cz";
    public static $SITENAME = "SOFTRIO s.r.o.";
    public static $WEB = "www.softrio.cz";
    public static $ADDRESS = "Poličanská 1487,";
    public static $ADDRESS2 = "190 16 Praha 9";
    public static $ICO = "07122993";
    public static $DIC = "CZ07122993";

    /**
     * Mail
     */
    public static $MAIL_HOST = "localhost";
    public static $MAIL_PORT = true;
    public static $MAIL_DEBUGMODE = true;
    public static $MAIL_USERNAME = "asdf";
    public static $MAIL_PASSWORD = "asdf";
    public static $MAIL_FROM = "locahost@localhost.cz";

    /**
     * Init
     */
    public static function init() {
        self::$USE_ALPHA_CLOSED_TEST = getenv("USEALPHACLOSED") == 'true';
    }
}