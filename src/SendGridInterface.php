<?php
declare(strict_types = 1);

namespace MrPrompt\Silex;

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
    const NAME = 'sengrid';

    /**
     * @param string $to
     * @param string $from
     * @param string $template
     * @param array $tags
     * @return boolean
     */
    public function send(string $to, string $from, string $template, array $tags = []): bool;
}
