# PHP Cloud Search

This is a simple app with some sample PHP code to search files in a
[Kloudless](https://kloudless.com) account and display them to the user.

## Installation

PHP 5.5+ is required.

[Composer](http://getcomposer.org) is used for dependency management.

To install composer:

    $ curl -sS https://getcomposer.org/installer | php

Install dependencies:

    $ php composer.phar install
    # OR (if globally installed):
    $ composer install

## Configuration

Modify config.php with the ID of the account to search, as well as
your app's API Key. Both can be obtained on the
Kloudless [Interactive Docs](https://developers.kloudless.com/interactive-docs/)
after logging in.

## Run

Run PHP 5.5's CLI web server:

    $ php -S 0:8000 router.php

Navigate to `localhost:8000` in your browser.
