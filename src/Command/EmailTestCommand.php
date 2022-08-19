<?php

declare(strict_types=1);

namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Core\Configure;
use Cake\Mailer\Mailer;
use Cake\Mailer\Message;
use Cake\Mailer\Transport\SmtpTransport;
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
        // (new Mailer())->setTo(['test@example.com' => 'Test User Name here'])
        //     ->setSubject('Hi this is a test')
        //     ->setEmailFormat('html')
        //     ->deliver("This is the content");

        $body = '<h1>Heading Test</h1><p>Paragragh Test</p>';

        $message = new \Cake\Mailer\Message();

        $message
            ->setFrom('admin@cakephp.org')
            ->setTo('user@foo.com')
            ->setBodyHtml($body)
            ->setEmailFormat('both')
            ->setBodyText(Html2Text::convert($body));

        $transport = (new TransportFactory())->get('default');

        $result = $transport->send($message);

        $io->out("Message sent!");
    }
}
