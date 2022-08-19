<?php

declare(strict_types=1);

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

        $faker = Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $fn = $faker->firstName();
            $ln = $faker->lastName();
            $dn = $faker->domainName();
            $data[] = [
                'name' => "{$fn} {$ln}",
                'email' => strtolower("{$fn}.{$ln}@{$dn}")
            ];
        }

        $table = $this->table('users');

        $table->truncate();

        $table->insert($data)->save();
    }
}
