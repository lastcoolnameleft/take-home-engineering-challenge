<?php
declare(strict_types=1);

const TRUCK_ID_COL=0;
const TRUCK_NAME_COL=1;
const TRUCK_LAT=14;
const TRUCK_LON=15;

if (sizeof($argv) < 3) {
  print "Usage: {$argv[0]} latitude longitude <food truck csv>\n";
  exit();
}
$lat = $argv[1];
$lon = $argv[2];
$csv_file = isset($argv[3]) ? $argv[3] : 'Mobile_Food_Facility_Permit.csv';
$truck_data = array_map('str_getcsv', file($csv_file)); # http://php.net/manual/en/function.str-getcsv.php#114764

$truck_distance = [];
# Dataset is tiny.  We can solve this via brute force.
foreach ($truck_data as $idx => $truck) {
  $truck_distance[$idx] = distance((float) $lat, (float) $lon, (float) $truck[TRUCK_LAT], (float) $truck[TRUCK_LON]);
}
asort($truck_distance); # Dear PHP, asort() modifies the input data.  You're better than that.

$top_five = array_slice($truck_distance, 0, 5, TRUE);

print "Closest food trucks:\n";
foreach ($top_five as $idx => $distance) {
  print "Distance: " . $distance . " miles\n";
  print "Name: {$truck_data[$idx][TRUCK_NAME_COL]} ({$truck_data[$idx][TRUCK_LAT]}, {$truck_data[$idx][TRUCK_LON]}) \n";
}

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
?>
