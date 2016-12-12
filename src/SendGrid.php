<?php

declare(strict_types = 1);

namespace SilexFriends\SendGrid;

use SendGrid as Sender;
use SendGrid\Email;
use SendGrid\Mail;
use SendGrid\Exception;

/**
 * SendGrid Adapter
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
final class SendGrid implements SendGridInterface
{
    /**
     * @var string
     */
    private $apiName;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * SendGrid constructor.
     *
     * @param string $name
     * @param string $key
     */
    public function __construct(string $name, string $key)
    {
        $this->apiName = $name;
        $this->apiKey = $key;
    }

    /**
     * @inheritdoc
     */
    public function send(string $to, string $from, string $template, array $tags = []): bool
    {
        try {

            $mail = new Mail($from, ' ', $to, ' ', $tags);
            $mail->setTemplateId($template);

            $sender = new Sender($this->apiKey);
            $sender->client->mail()->send($mail);

            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
}
