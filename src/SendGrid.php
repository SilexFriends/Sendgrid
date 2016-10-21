<?php
namespace SilexFriends\SendGrid;

use SendGrid as Sender;
use SendGrid\Email;
use SendGrid\Exception;
use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * SendGrid Service Provider
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
final class SendGrid implements SendGridInterface, ServiceProviderInterface
{
    /**
     * @var array
     */
    private $config;

    /**
     * SendGrid constructor.
     *
     * @param string $name
     * @param string $key
     */
    public function __construct(string $name, string $key)
    {
        $this->config = [
            'api_name' => $name,
            'api_key'  => $key,
        ];
    }

    /**
     * (non-PHPdoc)
     * @see \Silex\ServiceProviderInterface::register()
     */
    public function register(Application $app)
    {
        $app[static::NAME] = $app->protect(
            function ($to, $from, $template, $tags) {
                return $this->send($to, $from, $template, $tags);
            }
        );
    }

    /**
     * (non-PHPdoc)
     * @see \Silex\ServiceProviderInterface::boot()
     */
    public function boot(Application $app)
    {
        // :)
    }

    /**
     * @inheritdoc
     */
    public function send(string $to, string $from, string $template, array $tags = []): bool
    {
        try {
            $apiKey = $this->config['api_key'];

            $email  = new Email("", $to);
            $email
                ->addTo($to)
                ->setFrom($from)
                ->setSubject(' ')
                ->setHtml(' ')
                ->setTemplateId($template)
                ->setSubstitutions($tags);

            $sender = new Sender($apiKey);
            $sender->send($email);

            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
}
