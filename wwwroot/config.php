<?php declare(strict_types=1);

class AppConfig
{
    /**
     * @param string DOCUMENT_ROOT
     */
    public static $DOCUMENT_ROOT = '/projects/kyklop_web/';
    
    /**
     * Web Application
     */
    public static $LOCATION = "Praha";
    public static $PHONE = "+420 123456791";
    public static $EMAIL = "asd@asd.cz";
    public static $SITENAME = "Myramars s.r.o";
    public static $WEB = "www.myramars.cz";

    /**
     * Mail
     */
    public static $MAIL_HOST = "localhost";
    public static $MAIL_PORT = true;
    public static $MAIL_DEBUGMODE = true;
    public static $MAIL_USERNAME = "asdf";
    public static $MAIL_PASSWORD = "asdf";
    public static $MAIL_FROM = "locahost@localhost.cz";
}