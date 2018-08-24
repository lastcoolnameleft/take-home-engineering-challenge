# Developer Notes

## Requirements

* [https://php.net](PHP 7+)
* [https://getcomposer.org/download/](Composer)

## Design considerations

PHP was chosen for this exercise because I had already utilized and tested a lat/long to distance function 10 years ago which I have been relying upon for https://www.duckiehunt.com.  This helped reduce development time.

While not as "sexy" as Python, Node, etc. it is the 5th most popular language by Github PR's (See: https://octoverse.github.com/) and still has a strong community.

## Feature Request list

Features are tracked here: https://github.com/lastcoolnameleft/take-home-engineering-challenge/issues

## Dev Env setup

```shell
composer install
```

## Running Unit Tests

Tests are run by PHPUnit

```shell
cd test
../vendor/bin/phpunit  distanceTest.php
```