<?php

namespace SilexFriends\SendGrid\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use SilexFriends\SendGrid\SendGridInterfae;
use SilexFriends\SendGrid\SendGrid;

final class SendGridProvider implements ServiceProviderInterface
{
    /**
     * (non-PHPdoc)
     * @see \Silex\ServiceProviderInterface::register()
     */
    public function register(Application $app)
    {
        $app['sendgrid.adapter'] = $app->share(function (Application $app) {
            return new SendGrid(
                $app['sendgrid.api_name'],
                $app['sendgrid.api_key']
            );
        });

        $app['sendgrid'] = $app->protect(
            function ($to, $from, $template, $tags = []) use ($app) {
                return $app['sendgrid.adapter']->send($to, $from, $template, $tags);
            }
        );

        $app['sendgrid.api_name'] = null;
        $app['sendgrid.api_key'] = null;
    }

    /**
     * (non-PHPdoc)on
     * @see \Silex\ServiceProviderInterface::boot()
     */
    public function boot(Application $app)
    {
        // do nothing
    }
}
