<?php
namespace database;
use PDO;

class QueryBuilder {

    protected $DB;

    public function __construct( PDO $pdo )
    {
        $this->DB = $pdo;
    }

    function getAll( $table ) {
        if( empty( $this->DB ) ) return false;

        $query = "SELECT * FROM {$table}";
        $answer = $this->DB->query( $query );
        
        return $answer->fetchAll( PDO::FETCH_ASSOC );
    }

    function getAllFromColumn( $column, $table ) {
        if( empty( $this->DB ) ) return false;

        $query = "SELECT {$column} FROM {$table}";
        $answer = $this->DB->query( $query );

        return $answer->fetchAll( PDO::FETCH_ASSOC );
    }

    function getCount( $table ) {
        if( empty( $this->DB ) ) return false;

        $query = "SELECT COUNT(id)
                  FROM {$table}";
        $answer = $this->DB->query( $query );
        return ( $answer->fetch( PDO::FETCH_NUM ) )[0];        
    }

}