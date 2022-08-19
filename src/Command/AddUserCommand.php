<?php

declare(strict_types=1);

namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Queue\QueueManager;
use App\Job\AddUserJob;
use App\Factories\UserFactory;

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
            'name' => ['required' => false, 'help' => "Enter a user full name e.g. \"James McDonald\""],
            'email' => ['required' => false, 'help' => "Enter a user email e.g. \"james@toggen.com.au\""],
        ])->addOption('random', [
            'help' => "Generate a random user using Faker",
            'short' => 'r', 'boolean' => true
        ])
            ->setEpilog(['', 'Add a user to the database using the add_user queue']);
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
        if ($args->getOption('random')) {
            $data = (new UserFactory())->single();

            $name = $data['name'];

            $email = $data['email'];
        } else {
            $io->info(['', 'Enter details or CTRL C to exit'], 2);
            do {
                $name = $args->getArgument('name') ?? $io->ask('Enter a full name e.g. James McDonald');
            } while (empty($name));
            do {
                $email = $args->getArgument('email') ?? $io->ask('Enter an email address e.g. james@toggen.com.au');
            } while (empty($email));
        }




        QueueManager::push(
            AddUserJob::class,
            compact('email', 'name'),
            ['config' => 'add_user']
        );
    }
}
