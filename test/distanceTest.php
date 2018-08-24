<?php
declare(strict_types=1);

const TRUCK_ID_COL=0;
const TRUCK_NAME_COL=1;
const TRUCK_LAT_COL=2;
const TRUCK_LON_COL=3;

use PHPUnit\Framework\TestCase;
require_once('../src/distance.php');

final class DistanceTest extends TestCase
{
    private $test_data = [
        array(1, 'truck1', 37.7678524427181, -122.416104892532),
        array(2, 'truck2', 37.782143532929, -122.430449785949),
        array(3, 'truck3', 37.7943310032468,-122.395811053023),
        array(4, 'truck4', 37.7878896999061,-122.400535326777)
    ];

    public function testGetClosestTrucks(): void
    {
        $result = get_closest_trucks($this->test_data, 37.7943310032468, -122.400535326777, 2);

        // Should only be two results
        $this->assertEquals(count($result), 2);
        
        // The closest two should be truck3 & truck 4 (index 2 & 3)
        $this->assertEquals(array_keys($result), array(2, 3));
    }

    // Because formula is accurate to 5 decimal places, we should ensure value is inside range instead of exact value
    public function testDistance(): void
    {
        # Validated with 3rd party tool: https://andrew.hedges.name/experiments/haversine/
        $result = distance(37.7678524427181, -122.430449785949, 37.7678524427181, -122.416104892532);
        $this->assertTrue($result > 0.78 && $result < 0.79);
        
        $result = distance(37.7678524427181, -122.430449785949, 37.782143532929, -122.430449785949);
        $this->assertTrue($result > 0.98 && $result < 0.99);
    }
}
