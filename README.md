## Spryker Database Configuration
This modules provides a way to store specific configuration values inside
the database and enables back office users to modify them without a deployment.

### Steps to do for install
1. `composer require spryker-community/database-configuration`
2. Activate the navigation on project level
   - edit your `config/Zed/navigation.xml` and add the entries from the module `src/SprykerCommunity/Zed/DatabaseConfiguration/Communication/navigation.xml` to the root `navigation.xml`
   - clear the cache for navigation
     - `vendor/bin/console application:build-navigation-cache`
     - `vendor/bin/console router:cache:warm-up`
3. Setup our database structure
    - `vendor/bin/console propel:install`
    - `vendor/bin/console transfer:generate`
4. Configure Spryker Core Namespaces

Add the SprykerCommunity namespace to your Spryker configuration:

File: `config/Shared/config_default.php`

```php
<?php

// Add SprykerCommunity to the core namespaces array
$config[KernelConstants::CORE_NAMESPACES] = [
    'SprykerCommunity',  // Add this line
    'SprykerShop',
    'SprykerEco',
    'Spryker',
    'SprykerSdk',
];
```
