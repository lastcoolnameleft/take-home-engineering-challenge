<?php

/*
 * Awesome!  I already wrote a php function 10 years ago which calculates distance from a lat/long
 * https://github.com/lastcoolnameleft/duckiehunt/blob/master/app/application/helpers/duck_helper.php#L4-L14
 * Because the earth is round, curved math is involved.  Thankfully, someone else has done the hard work
 * NOTE: This forumla is only precise to 5 decimal points (1.1m) https://gis.stackexchange.com/a/8674
 * 
 * Arguments:
 *  lat1 (float): Latitude #1 to compare distance
 *  lon1 (float): Longitude #1 to compare distance
 *  lat2 (float): Latitude #2 to compare distance
 *  lon2 (float): Longitude #2 to compare distance
 * 
 */
function distance(float $lat1, float $lon1, float $lat2, float $lon2): float {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    return $miles;
}

/* 
 * Dataset is tiny.  We can solve this via brute force.
 * 
 * Arguments:
 *  truck_data (array of arrays): CSV exported data
 *  lat (float): Latitude to compare distance
 *  lon (float): Longitude to compare distance
 *  result_count (int): Number of results to return
 */
function get_closest_trucks(array $truck_data, float $lat, float $lon, int $result_count=5): array {
    foreach ($truck_data as $idx => $truck) {
        $truck_distance[$idx] = distance((float) $lat, (float) $lon, (float) $truck[TRUCK_LAT_COL], (float) $truck[TRUCK_LON_COL]);
    }
    asort($truck_distance); # Dear PHP, asort() modifies the input data.  You're better than that.
   
    # The last TRUE parameter is to retain the index, which is important since that's how we'll tie back to the CSV data's array idx
    $result = array_slice($truck_distance, 0, $result_count, TRUE);
    return $result;
}
?>