<?php
declare(strict_types=1);
require_once('src/distance.php');

const TRUCK_ID_COL=0;
const TRUCK_NAME_COL=1;
const TRUCK_LAT_COL=14;
const TRUCK_LON_COL=15;
const RESULT_COUNT=5; 

if (sizeof($argv) < 3) {
  print "Usage: {$argv[0]} latitude longitude <food truck csv>\n";
  exit();
}
$lat = $argv[1];
$lon = $argv[2];
$csv_file = isset($argv[3]) ? $argv[3] : 'Mobile_Food_Facility_Permit.csv';
$truck_data = array_map('str_getcsv', file($csv_file)); # http://php.net/manual/en/function.str-getcsv.php#114764

$results = get_closest_trucks($truck_data, (float) $lat, (float) $lon, RESULT_COUNT);

print "Closest food trucks:\n";
foreach ($results as $idx => $distance) {
  print "Distance: {$distance} miles\n";
  print "Name: {$truck_data[$idx][TRUCK_NAME_COL]} ({$truck_data[$idx][TRUCK_LAT_COL]}, {$truck_data[$idx][TRUCK_LON_COL]}) \n\n";
}

?>