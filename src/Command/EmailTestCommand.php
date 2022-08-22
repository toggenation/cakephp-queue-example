<?php

declare(strict_types=1);

namespace App\Command;

use App\Mailer\NotifyMailer;
use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Mailer\Message;
use Cake\Mailer\TransportFactory;
use Soundasleep\Html2Text;

/**
 * EmailTest command.
 */
class EmailTestCommand extends Command
{
    /**
     * Hook method for defining this command's option parser.
     *
     * @see https://book.cakephp.org/4/en/console-commands/commands.html#defining-arguments-and-options
     * @param \Cake\Console\ConsoleOptionParser $parser The parser to be defined
     * @return \Cake\Console\ConsoleOptionParser The built parser.
     */
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser = parent::buildOptionParser($parser);

        return $parser;
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return null|void|int The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $mailer = new NotifyMailer();

        // $mailer->send('notify', ["james@toggen.com.au", "James McDonald", ['subject' => "Test Email", 'body' => "test body"]]);
        $mailer->send('failed', [
            "james@toggen.com.au", "James McDonald", "Error Message Here"
        ]);

        // $message = new Message();

        // $bodyHtml = '<h1>Test heading</h1><p>Test paragraph</p>';

        // $message->setFrom("admin@example.com")
        //     ->setSubject("A test message using Message and Transport instead of Mailer class")
        //     ->setTo('user@example.com')
        //     ->setBodyHtml($bodyHtml)
        //     ->setBodyText(Html2Text::convert($bodyHtml))
        //     ->setEmailFormat('both');

        // $transport = (new TransportFactory())->get('default');

        // $result = $transport->send($message);

        $io->out("Message sent!");
    }
}
