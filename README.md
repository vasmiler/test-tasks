# test-tasks
## Check SEO attributes

#### how to run:
php checkSeoAttributes.php filename


## Check preview is playing
#### requirement:
php_imagick
used the instruction for installation: https://herbmiller.me/installing-imagick-php-7/

#### how to install Codeception and Visualception:
php composer.phar install <br>
vendor\bin\codecept bootstrap

#### run selenium server:
java -jar selenium-server-standalone-3.141.59.jar

#### run tests:
vendor\bin\codecept run acceptance

#### checked with:
php: PHP 7.3.7
chrome: 75.0.3770.100
selenium standalone server: 3.141.59

#### note:
There is a little offset while getting the screenshot using Visualception.
Probably it is a bug in getting coordinates of an element or my mistake.
But finally, it's possible to found if the preview is changed.
In addition, I checked that not changeable area (Yandex logo) is not changed.
