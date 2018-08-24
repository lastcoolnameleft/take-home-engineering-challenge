# Usage

## Requirements

* PHP 7+

## Execution

`food-truck-finder.php` has 2 required parameters and 1 optional.

Required:

* Latitude:  (float)
* Longitude: (float)

Optional:

* Food Truck DB: (string) The file path of a Mobile Food Facility Permit

## Examples

```shell
php ./food-truck-finder.php 37.74530 -122.40342  Mobile_Food_Facility_Permit.csv
```

## But I don't know my latitude and longitude

No problem. We can get a reasonable proximity by using IP GeoProximity. (http://ip-api.com/docs/api:json)

```shell
LAT=$(curl -s http://ip-api.com/json | jq '.lat')
LON=$(curl -s http://ip-api.com/json | jq '.lon')
php ./food-truck-finder.php $LAT $LON
```

## Accuracy

It is worth noting that this program is only accurate to 5 decimal points (~1.1 meters).  

For accuracy/precision information, see: https://gis.stackexchange.com/a/8674