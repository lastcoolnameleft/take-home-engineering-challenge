# Developer Notes

## Requirements

* PHP 7+

## Design considerations

PHP was chosen for this exercise because I had already utilized and tested a lat/long to distance function 10 years ago which I have been relying upon for https://www.duckiehunt.com.  This helped reduce development time.

While not as "sexy" as Python, Node, etc. it is the 5th most popular language by Github PR's (See: https://octoverse.github.com/) and still has a strong community.

## Feature Request list

* Allow user to specify location instead of lat/lon
  * https://developers.google.com/maps/documentation/geocoding/intro
* Allow user to not specify location which looks up lat/long by IP
  * http://ip-api.com/docs/api:json 