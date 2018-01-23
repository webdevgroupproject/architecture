<?php
/**
 * Created by PhpStorm.
 * User: Ross
 * Date: 25/10/2017
 * Time: 09:25
 */

class databaseConn {
    // private statics to hold the connection
    private static $dbConnection = null;

    // make the next 2 functions private to prevent normal
    // class instantiation
    private function __construct() {
    }
    private function __clone() {
    }

    /**
     * Return DB connection or create initial connection
     * @return object (PDO)
     * @access public
     */
    public static function getConnection($dsn='mysql:host=localhost;dbname=blueprint_db', $username='root', $password='root') {
        // if there isn't a connection already then create one
        if ( !self::$dbConnection ) {
            try {
                // connection options to include using exception mode
                $options = array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                );
                // pass in the options as the last parameter so pdo uses exceptions
                self::$dbConnection = new PDO( $dsn, $username, $password, $options );
            }
            catch( PDOException $e ) {
                // in a production system you would log the error not display it
                echo $e->getMessage();
            }
        }
        // return the connection
        return self::$dbConnection;
    }

}
