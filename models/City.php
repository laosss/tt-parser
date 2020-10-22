<?php

class City {

    private $lat;   // координаты города, сдесь долгота и широта
    private $long;  // возможно есть более подходящий вариант

    // function __construct( $lt=null, $lng=null ) {
    //     $this->lat = $lt;
    //     $this->long = $lng;
    // }

    function getLocation() {
        return $this->lat .','. $this->long;
    }

    function setLocation( $lt, $lng ) {
        $this->lat = $lt;
        $this->long = $lng;
    }

}