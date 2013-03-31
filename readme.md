sfPersianTools
=============

Persian tools for [Sumfony](http://symfony.com/ "Symfony") framework.

Installation
-------------

### Step 1: Download PersianToolsBundle using composer ###

Add PersianToolsBundle in your composer.json

```json
{
    "require": {
        "intuxicated/persian-tools-bundle": "0.1.*@dev"
    }
}
```

Now tell composer to download the bundle by running the command

```bash
$ php composer.phar update intuxicated/persian-tools-bundle
```

### Enable the bundle ###

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Intuxicated\PersianToolsBundle\PersianToolsBundle(),
    );
}
```

Twig Filters
-------------

```jinja

{{ '1364509205'|pdate }} {# result: 1392-01-09 #}
{{ '1364509205'|pdate('Y-m-d H:i:s') }} {# result: 1392-01-09 02:50:05 #}

{{ '123456789'|pnumber  }} {# result: ۱۲۳۴۵۶۷۸۹ #}

{{ 'ملك عربي'|pletter }} {# result: 'ملک عربی'#}


```

Twig Functions
-------------

[pdate](http://www.php.net/manual/en/function.date.php)

[pstrftime](http://www.php.net/manual/en/function.strftime.php)

[pmktime](http://www.php.net/manual/en/function.mktime.php)

[pcheckdate](http://www.php.net/manual/en/function.checkdate.php)

[pgetdate](http://www.php.net/manual/en/function.getdate.php)

DayOfYear `return past days of the year`

isKabise `return true if year is intercalary`

License
-------------
GPLv3 , (more information)[https://github.com/intuxicated/sfPersianToolsBundle/blob/master/LICENSE]