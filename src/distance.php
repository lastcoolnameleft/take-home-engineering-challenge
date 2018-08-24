<?php

# Awesome!  I already wrote a php function 10 years ago which calculates distance from a lat/long
# https://github.com/lastcoolnameleft/duckiehunt/blob/master/app/application/helpers/duck_helper.php#L4-L14
# NOTE: This forumla is only precise to 5 decimal points (1.1m) https://gis.stackexchange.com/a/8674
function distance($lat1, $lon1, $lat2, $lon2) {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    return $miles;
}

# Dataset is tiny.  We can solve this via brute force.
function get_closest_trucks($truck_data, $lat, $lon, $result_count=5) {
    foreach ($truck_data as $idx => $truck) {
        $truck_distance[$idx] = distance((float) $lat, (float) $lon, (float) $truck[TRUCK_LAT], (float) $truck[TRUCK_LON]);
    }
    asort($truck_distance); # Dear PHP, asort() modifies the input data.  You're better than that.
   
    # The last TRUE parameter is to retain the index, which is important since that's how we'll tie back to the CSV data's idx
    $top_five = array_slice($truck_distance, 0, $result_count, TRUE);
    return $top_five;
}
?>