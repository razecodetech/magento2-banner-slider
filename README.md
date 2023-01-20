# Magento 2 Banner Slider

[![Latest Stable Version](https://poser.pugx.org/razecode/banner/v/stable)](https://packagist.org/packages/razecode/banner)
[![Total Downloads](https://poser.pugx.org/razecode/banner/downloads)](https://packagist.org/packages/razecode/banner)

## How to install & upgrade Razecode_Banner

### 1. Install via composer (recommend)

We recommend you to install Razecode_Banner module via composer. It is easy to install, update and maintaince.

Run the following command in Magento 2 root folder.

#### 1.1 Install

```
composer require razecode/banner
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

#### 1.2 Upgrade

```
composer update razecode/banner
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

Run compile if your store in Production mode:

```
php bin/magento setup:di:compile
```

### 2. Copy and paste

If you don't want to install via composer, you can use this way. 

- Download [the latest version here](https://github.com/razecodetech/banner/archive/master.zip) 
- Extract `master.zip` file to `app/code/Razecode/Banner` ; You should create a folder path `app/code/Razecode/Banner` if not exist.
- Go to Magento root folder and run upgrade command line to install `Razecode_Banner`:

```
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```
