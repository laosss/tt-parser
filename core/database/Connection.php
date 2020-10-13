<?php
namespace database;
use PDO;
use PDOException;


class Connection {

    static function make($config) {
        
        $conStr = $config['type'] 
                  . ":host=" . $config['host']
                  . ";dbname=" . $config['name'] 
                  . ";charset=" . $config['enc'] 
                  . ";";
        
        try {
            return new PDO( $conStr, $config['user'], $config['pass'], $config['options'] );
        } catch( PDOException $ex ) {
            throw $ex;
        }
    }

}