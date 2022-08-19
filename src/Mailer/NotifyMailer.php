<?php

declare(strict_types=1);

namespace App\Mailer;

use Cake\Mailer\Mailer;
use Cake\Queue\Mailer\QueueTrait;

/**
 * Notify mailer.
 */
class NotifyMailer extends Mailer
{
    use QueueTrait;

    /**
     * Mailer's name.
     *
     * @var string
     */
    public static $name = 'Notify';

    public function notify(string $email, string $username)
    {
        $this->setSubject(sprintf("Test email %s %s", $email, $username))
            ->setViewVars(compact('email', 'username'))
            ->setEmailFormat('both')
            ->setTo([$email => $username])
            ->viewBuilder()->setTemplate('test');
    }



    public function failed(string $email, string $username, string $error)
    {
        $this->setSubject(sprintf("Add User Failed for %s - %s - with error %s ", $email, $username, $error))
            ->setTo(['admin@example.com' => "Admin User"])
            ->viewBuilder()->setTemplate(null);
    }
}
