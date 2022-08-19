<?php

namespace App\Factories;

use Faker\Factory;

class UserFactory
{
    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function single()
    {
        $fn = $this->faker->firstName();
        $ln = $this->faker->lastName();
        $dn = $this->faker->domainName();

        return [
            'name' => "{$fn} {$ln}",
            'email' => strtolower("{$fn}.{$ln}@{$dn}")
        ];
    }

    public function make($count = 1)
    {
        for ($i = 0; $i < $count; $i++) {
            $users[] = $this->single();
        }

        return $users;
    }
}
