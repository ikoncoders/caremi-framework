<?php declare(strict_types=1);

namespace Caremi\Mailer;

use Caremi\Mailer\MailerFactory;

class MailerFacade
{
    /** @var object */
    protected object $mailer;

    /**
     * Facade main constructor method which creates an object the mailer factory
     * class and pipe the Object to the class property.
     *
     * @param array|null $settings
     */
    public function __construct(?array $settings = null)
    { 
        $this->mailer =  (new MailerFactory($settings))->create(\PHPMailer\PHPMailer\PHPMailer::class);
    }

    /**
     * Quickly send a basic email which comprises of the argument listed in the method
     * below. Note this basic mail method does not send attachments
     *
     * @param string $subject
     * @param string $from - Who the eail from
     * @param string $to - Who sending the email to
     * @param string $message
     * @return void
     * @throws MailerException
     */
    public function basicMail(string $subject, string $from, string $to, string $message)
    {
        return $this->mailer
        ->subject($subject)
        ->from($from)
        ->address($to)
        ->body($message)
        ->send();
        
    }

}