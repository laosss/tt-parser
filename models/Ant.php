<?php

class Ant {
    private $current_location;
    public $distance_traveled;
    public $have_been_list;
    private $next_location;
    public $tour_list;  // ant's tour

    function get_current_location() { return $this->current_location; }
    function set_current_location( $curr_loc ) { $this->current_location = $curr_loc; }

    function __construct( $start_pos=null, $num_cities=null ) {
        if( $start_pos != null && $num_cities != null ) {
            $this->current_location = $start_pos;
            $this->have_been_list = [$num_cities];
        } else { $this->have_been_list = []; }
        $this->tour_list = [];
    }

    function get_distance() { return $this->distance_traveled; }

    function reset_distance() { $this->distance_traveled = 0; }

    function set_next_location( $location ) { $this->next_location = $location; }

    function update_total_distance( $d ) { $this->distance_traveled = $d; }

}