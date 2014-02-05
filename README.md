Earnings
---
First off, I'd like to thank you for your support and interest in this open source project.

The `Earnings` class is a useful PHP object used to receive, print, and manipulate earning statistics through various ad networks. The `Earnings` class is versatile in a way where you can simply create subclasses to easily parse data and integrate earning statistics from any affiliate, PPC, or CPA ad networks.

How To (EXAMPLES)
---
The following are usage examples to properly use the Earnings Object.

If you would like to use a pre-existing network from our subclasses, you must create the instance using the required arguments in the constructor method or comment block.

###Creating a sub-class or adding support for a new network###
Adding support for a new network is easy! Simply look at the available methods in `Earnings.class.php` or the constructor method from `Demo.class.php`.

###Ex 1: Printing Earnings from a network###
We will be using AdworkMedia for this example.

*Example 1*: Prepare the `Earnings` Class with network/object `AdworkMedia`:

```php
require_once("./lib/Earnings.class.php");
require_once("./lib/AdworkMedia.class.php");
```

*Example 2*: Instantiate the AdworkMedia and Earnings Object:

Arguments from AdworkMedia Constructor Method: `function __construct($email = NULL, $base64pw = NULL)` (You can see that the publisher email address and base64 encoded password is required.)
```php
$adworkmedia = new AdworkMedia("user@email.com","cGFzc3dvcmQ=");
```

*Example 3*: Printing the table of earnings from Earnings Object:
```php
$adworkmedia->printEarnings();
```

*Example 4*: Getting specific earnings from network:
```php
echo "Today I've generated {$adworkmedia->getLeadsToday()} leads and earned {$adworkmedia->getEarningsToday()}";
```

###Ex 2: Printing Earnings from multiple networks###
There is a subclass named `TotalEarnings` that you can use to combine all of the other `Earnings` instances that you've created.
```php
$network1 = new AdworkMedia("user@email.com","cGFzc3dvcmQ=");
$network2 = new Demo("pubid","apikey");
$total = new TotalEarnings(array($network1,$network2));
$total->printEarnings();
```

###Ex 3: Customization###
I've designed this class to be simple yet easy to customize. All the output from `Earnings::printEarnings()` is put into an styleless table. There are two methods available that can be used to either:

Set the network name:
```php
$obj->setNetworkName($networkname);
```

Set the table class:
```php
$obj->setTableClass($tableclassname);
```

Please Contribute!
---
Advertising networks, publishers, and supporters are encouraged to contribute to this project by sending in a pull request. I welcome and will approve any efficient and functional new subclass or improvements to the existing repository. I do ask that you do not add affiliate or tracking URLs to any of the code or comments to prevent spam and bloat.

Feel free to also fork / watch this project so I can anticipate the demand for updates! Thank you once again for taking the time to look through this repo.