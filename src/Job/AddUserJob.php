<?php

declare(strict_types=1);

namespace App\Job;

use Cake\Log\LogTrait;
use Cake\Mailer\MailerAwareTrait;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\Queue\Job\JobInterface;
use Cake\Queue\Job\Message;
use Cake\Utility\Hash;
use Cake\Utility\Text;
use Interop\Queue\Processor;

/**
 * AddUser job
 */
class AddUserJob implements JobInterface
{
    use LocatorAwareTrait;
    use MailerAwareTrait;
    use LogTrait;

    /**
     * The maximum number of times the job may be attempted.
     * 
     * @var int|null
     */
    public static $maxAttempts = 3;

    /**
     * Executes logic for AddUserJob
     *
     * @param \Cake\Queue\Job\Message $message job message
     * @return string|null
     */
    public function execute(Message $message): ?string
    {
        $usersTable = $this->fetchTable('Users');

        $data = $message->getArgument();

        // $this->log(print_r([
        //     'parsedBody' => $message->getParsedBody(),
        //     'context' => $message->getContext(),
        //     'args' => $message->getArgument(),
        //     'orig' => $message->getOriginalMessage()
        // ], true));

        // $this->log(print_r($data, true));

        $user = $usersTable->newEntity($data);

        if ($usersTable->save($user) === false) {
            $error = Text::toList(array_values(Hash::flatten($user->getErrors())));

            /**
             * @var \App\Mailer\NotifyMailer $mailer
             */
            $mailer = $this->getMailer('Notify');

            $mailer->push('failed', [$data['email'], $data['name'], $error]);

            return Processor::REJECT;
        }

        return Processor::ACK;
    }
}
