<?php

declare(strict_types=1);

namespace App\Command;

use App\Job\AddUserJob;
use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Queue\QueueManager;

/**
 * AddUser command.
 */
class AddUserCommand extends Command
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

        return $parser->addArguments([
            'full_name' => ['required' => true, 'help' => "Enter a user full name e.g. \"James McDonald\""],
            'email' => ['required' => true, 'help' => "Enter a user email e.g. \"james@toggen.com.au\""],
        ])->setEpilog("This command enters a record in the users table");
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

        [$full_name, $email] = $args->getArguments();

        QueueManager::push(AddUserJob::class, compact('full_name', 'email'), ['config' => 'add_user']);
    }
}
