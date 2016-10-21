# Silex SendGrid Provider

[![Build Status](https://travis-ci.org/SilexFriends/Sendgrid.svg?branch=master)](https://travis-ci.org/SilexFriends/Sendgrid)
[![Code Climate](https://codeclimate.com/github/SilexFriends/Sendgrid/badges/gpa.svg)](https://codeclimate.com/github/SilexFriends/Sendgrid)
[![Test Coverage](https://codeclimate.com/github/SilexFriends/Sendgrid/badges/coverage.svg)](https://codeclimate.com/github/SilexFriends/Sendgrid/coverage)
[![Issue Count](https://codeclimate.com/github/SilexFriends/Sendgrid/badges/issue_count.svg)](https://codeclimate.com/github/SilexFriends/Sendgrid)


## Install
```
composer require mrprompt/silex-sendgrid
```

## Usage
```
use SilexFriends\SendGrid\SendGrid as SendGridServiceProvider;

$app->register(
    new SendGridServiceProvider(
        $api_name,
        $api_key
    )
);

$app['sendgrid'](
    'foo@bar.bar', // to
    'noreply@foobar', // from
    'template-name', // template name
    ['name' => ['Foo Bar']] // template tags
);

```

## Tests

```
./vendor/bin/phpunit
```

## License

MIT