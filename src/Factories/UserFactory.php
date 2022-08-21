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
        $fullName = "{$fn} {$ln}";
        $email = strtolower("{$fn}.{$ln}@{$dn}");
        return [
            'full_name' => $fullName,
            'email' => $email
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
