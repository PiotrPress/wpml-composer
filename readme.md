# WPML Composer

This composer plugin enables installation of [WPML](https://wpml.org) (WordPress Multilingual) plugin and its components.

## Example

```shell
$ composer require wpml/sitepress-multilingual-cms:*
$ composer require wpml/woocommerce-multilingual:*
```

**NOTE:** Package name can be any WPML component [slug](https://d2salfytceyqoe.cloudfront.net/wpml33-products.json).

## Installation

You need to follow these steps only once to install the plugin:

1. Provide WPML `user_id` and `subscription_key` from your [account](https://wpml.org/account/):

```shell
$ composer config -g http-basic.wpml.org <user_id> <subscription_key>
```

**NOTE:** using `-g` option is recommended to keep credentials outside of project's files.

2. Allow the plugin execution:

```shell
$ composer config -g allow-plugins.piotrpress/wpml-composer true
```

3. Add the plugin as a global composer requirement:

```shell
$ composer global require piotrpress/wpml-composer
```

## Usage

The WPML plugin and its addons have a type set to `wordpress-plugin` and can be installed in custom location using for example [Composer Installers](https://github.com/composer/installers): 

```json
{
  "require": {
    "wpml/sitepress-multilingual-cms": "*",
    "wpml/woocommerce-multilingual": "*",
    "composer/installers": "^2.0"
  },
  "config": {
    "allow-plugins": {
      "composer/installers": true
    }
  },
  "extra": {
    "installer-paths": {
      "wp-content/plugins/{$name}/": [
        "type:wordpress-plugin"
      ]
    }
  }
}
```

## Requirements

- PHP >= `7.4` version.
- Composer ^`2.0` version.

## License

[MIT](license.txt)