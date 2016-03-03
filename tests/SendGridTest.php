<?php
namespace MrPrompt\Silex\Tests;

use MrPrompt\Silex\SendGrid;
use PHPUnit_Framework_TestCase;
use Silex\Application;

/**
 * SendGrid Service Test Case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class SendGridTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Application
     */
    private $app;

    /**
     * Bootstrap
     */
    public function setUp()
    {
        parent::setUp();

        $api_name = getenv('SENDGRID_API_NAME');
        $api_key  = getenv('SENDGRID_API_KEY');

        $app     = new Application;
        $app->register(new SendGrid($api_name, $api_key));

        $this->app = $app;
    }

    /**
     * Shutdown
     */
    public function tearDown()
    {
        $this->app = null;

        parent::tearDown();
    }

    /**
     * @test
     */
    public function sendWithValidEmailAndTemplateMustBeReturnTrue()
    {
        $email      = getenv('SENDGRID_EMAIL');
        $template   = getenv('SENDGRID_TEMPLATE_ID');

        $result     = $this->app[SendGrid::NAME]($email, $email, $template, []);

        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function sendWithValidEmailAndInvalidTemplateMustBeReturnTrue()
    {
        $email      = getenv('SENDGRID_EMAIL');
        $template   = 'foo';

        $result     = $this->app[SendGrid::NAME]($email, $email, $template, []);

        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function sendWithInvalidEmailMustBeReturnTrue()
    {
        $email      = 'foo';
        $template   = getenv('SENDGRID_TEMPLATE_ID');

        $result     = $this->app[SendGrid::NAME]($email, $email, $template, []);

        $this->assertTrue($result);
    }
}
