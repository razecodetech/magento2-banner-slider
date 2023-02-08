# Magento 2 Banner Slider

[![Latest Stable Version](https://poser.pugx.org/razecode/banner/v/stable)](https://packagist.org/packages/razecode/banner)
[![Total Downloads](https://poser.pugx.org/razecode/banner/downloads)](https://packagist.org/packages/razecode/banner)

## How to install & upgrade Razecode_Banner

### 1. Install via composer (recommend)

We recommend you to install Razecode_Banner module via composer. It is easy to install, update and maintaince. 

Please use composer 2 to avoid any error while installing.

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

- Download [the latest version here](https://github.com/razecodetech/magento2-banner-slider/archive/refs/heads/main.zip) 
- Extract `master.zip` file to `app/code/Razecode/Banner` ; You should create a folder path `app/code/Razecode/Banner` if not exist.
- Go to Magento root folder and run upgrade command line to install `Razecode_Banner`:

```
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

## Screenshot
[![homepage-banner-slider.png](https://i.postimg.cc/jjLgL4B1/homepage-banner-slider.png)](https://postimg.cc/zLYSQKzw)

## Use below code to add Banner on CMS page and Static Block

<b>1. Add banner manually</b>

<code>{{block class="Razecode\Banner\Block\BannerSlider" template="Razecode_Banner::bannerslider.phtml" name="razecode.banner"}}</code>

<b>2. Add banner from admin configuration</b>

Go to:

`Store > Configuration > Razecode > Banner Slider > General Configuration > Display Slider from layout xml file (default)`

<b>NOTE:</b>

This extension requires base module. 

Download Base Module [latest version here](https://github.com/razecodetech/module-base/archive/refs/heads/main.zip) 
