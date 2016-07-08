<?php
declare(strict_types = 1);

namespace SilexFriends\SendGrid;

/**
 * SendGrid Service Provider
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
interface SendGridInterface
{
    /**
     * @var string
     */
    const NAME = 'sendgrid';

    /**
     * @param string $to
     * @param string $from
     * @param string $template
     * @param array $tags
     * @return boolean
     */
    public function send(string $to, string $from, string $template, array $tags = []): bool;
}
