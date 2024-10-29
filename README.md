# DateManager
The Data Manager  class is a work is progress class designed to be distributed with the lazarus framework.

    This Documentation is currently in a work in progress state and may not be upto date.

## Installing
it is recommended to install the datamanager class using composer.

```
composer require lazarusphp/datemanager
```


## Managing timezones
By default the timezone is set to the servers timezone configuration

### Setting timezones 
 the Current timezone can be overwritten by using the setTimeZone() method, the below example will set the default timezone to Europe/London

[click here to View Supported timezones](https://www.php.net/manual/en/timezones.php)

```php

use Lazarusphp\DateManager\Date;
Date::setTimeZone("Europe/London");

```
> ### Make Note

    if changing the timezone is a perminent action, it is recommened to add the setTimezone Metod before loading any code that requires the Date class


### Displaying the current timezone.
it is possible to retrieve the currently set timezone by using the getTimeZone Method, this method works even if no default timezone has been set. this can be done like so.

```php
use Lazarusphp\DateManager\Date;
Date::getTimeZone("Europe/London");

```

## Creating a new Date
if you need to create a new date this can be accommplished by using the create() method

in order to create a and display a new Date this can be done using Date::create($value);

```php

use Lazarusphp\DateManager\Date;
$date = Date::create("24-12-03");

```

> Make note

    it is not required to pass a timezone into the create class as this is done eiter by the callTimeZone method, this method checks if the getTimeZone() method has been set or not, as shown above if noting is set the server default timezone will be loaded.

    it is important to mention  that create() method replicates new DateTime() class and does give the ability to use other methods attached this includes format();

 using echo with create alone will cause an error and to output a date requires the format method

 ```php

use Lazarusphp\DateManager\Date;
$date = Date::create("24-12-03");
echo $date->format("d/m/y H:i:s p");

```

if the current date was the 3rd december 2024 at 10:50am this would output as 03/12/24 10:50am, even though the value is in a different the order the format method overrides this into a readable format.

optionally a global setting can be assigned and called by using the setFormat($format) method and can then be called by using $format property like so.

```php

use Lazarusphp\DateManager\Date;
Date::setFormat("d/m/y H:i:s p");
$date = Date::create("24-12-03");
echo $date->format(Date::$format);

```

> Make note

if it is a requirment that the format needs changing omn a constant basis, it will only change the formats called after the setFormat() method and any called previously will stay intact.

### getting the difference between two dates.
it is possible to get the difference between two dates and can be accommplished by using the createDiff method, the creatediff Method calls internally calls the create() method and diff method together. the createDiff() method can be called like so.

by default $format is set to y-m-d h:i:s
```php

use Lazarusphp\DateManager\Date;
$date = Date::createDiff("now","25-12-03","hours|mins|seconds");
echo $date;

```

the following snippet will output hhow many hours minutes and seconds have elapsed between the two dates.

> Make note

    by leaving the format empty will result in displaying how many days have elapsed between the two dates, however specifying the format will output be done in the order or years days hours minutes and seconds,

    the format must be written and split with a pipe (veritcal line) in order to work

    years| days

    output :  x year and xx days 

    hours|minutes
     output : x hours and x minutes

### Converting to timestamp

if needed the datetime can also be converted into a unix timestamp, this can be accomplished by using the asTimeStamp() method

```php
use Lazarusphp\DateManager\Date;
$date = Date::create("now");
Date::asTimeStamp($date);
echo $date;
```

this would output with the date of :  24-10-29 06:46:29pm or as a timestamp : 1730227589

### Adding Time to a date;

### Removing time from a date






 








