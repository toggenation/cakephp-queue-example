<?php

namespace App\Listener;

use Cake\Event\Event;
use Cake\Event\EventListenerInterface;
use Cake\Log\LogTrait;
use Cake\Utility\Text;
use Psr\Log\LogLevel;

class WorkerListener implements EventListenerInterface
{
    use LogTrait;

    public function implementedEvents(): array
    {
        /**
         * Processor.message.exception:
         * description: Dispatched when a message throws an exception.
         * arguments: message and exception
         * 
         * Processor.message.invalid:
         * description: Dispatched when a message has an invalid callable.
         * arguments: message
         * 
         * Processor.message.reject:
         * description: Dispatched when a message completes and is to be rejected.
         * arguments: message
         * 
         * Processor.message.success:
         * description: Dispatched when a message completes and is to be acknowledged.
         * arguments: message
         * 
         * Processor.message.failure:
         * description: Dispatched when a message completes and is to be requeued.
         * arguments: message
         * 
         * Processor.message.seen:
         * description: Dispatched when a message is seen.
         * arguments: message
         * 
         * Processor.message.start:
         * description: Dispatched before a message is started.
         * arguments: message
         */

        return [
            'Processor.message.exception' => 'processorMessageException',
            'Processor.message.invalid' => 'processorMessageInvalid',
            'Processor.message.reject' => 'processorMessageReject',
            'Processor.message.success' => 'processorMessageSuccess',
            'Processor.message.failure' => 'processorMessageFailure',
            'Processor.message.seen' => 'processorMessageSeen',
            'Processor.message.start' => 'processorMessageStart',
        ];
    }

    public function processorMessageException($message, $exception)
    {
        $this->log(__METHOD__);
    }

    public function processorMessageInvalid($message)
    {
        $this->log(__METHOD__);
    }

    public function processorMessageReject($message)
    {
        $this->log(__METHOD__);
    }

    public function processorMessageSuccess(Event $message)
    {
        /**
         * @var \Cake\Queue\Job\Message $cakeMessage
         */
        $cakeMessage = $message->getData('message');

        // $this->log(print_r($cakeMessage->getArgument(), true));

        $email = $cakeMessage->getArgument()['args'][0];

        $fullName = $cakeMessage->getArgument()['args'][1];

        $this->log("Success: {$fullName} <{$email}>", LogLevel::INFO);
    }

    public function processorMessageFailure($message)
    {
        $this->log(__METHOD__);
    }

    public function processorMessageSeen($queueMessage)
    {
        // $this->log(__METHOD__);
    }

    public function processorMessageStart($message)
    {
        // $this->log(__METHOD__);
    }
}
