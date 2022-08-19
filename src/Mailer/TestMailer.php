<?php

declare(strict_types=1);

namespace App\Mailer;

use Cake\Mailer\Mailer;

/**
 * Test mailer.
 */
class TestMailer extends Mailer
{
    /**
     * Mailer's name.
     *
     * @var string
     */
    public static $name = 'Test';


    public function test($email, $username)
    {
        $this->setSubject(sprintf("Test email %s %s", $email, $username))
            ->setViewVars(compact('email', 'username'))
            ->setEmailFormat('both')
            ->setTo([$email => $username]);

        // ->viewBuilder()->setTemplate(null);
    }
}
