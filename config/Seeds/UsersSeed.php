<?php

declare(strict_types=1);

use App\Factories\UserFactory;
use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = (new UserFactory())->make(20);

        $table = $this->table('users');

        $table->truncate();

        $table->insert($data)->save();
    }
}
