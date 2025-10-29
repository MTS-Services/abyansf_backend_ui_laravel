<?php 

use Carbon\Carbon;
if(! function_exists('format_date_time')) {

    function format_date_time($dateTime) {
        if (is_null($dateTime)) {
           return 'Not Set';
        }

        return Carbon::parse($dateTime)->format('m-d-Y - H:i:s , a');
    }
}

