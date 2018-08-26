<?php

namespace Tests\Feature\Controllers\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserRegistrationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function new_user_can_register()
    {
        $this->visit(route('register'));

        $this->submitForm(__('Register'), [
            'name'                  => 'Nama User',
            'email'                 => 'email@mail.com',
            'password'              => 'password.111',
            'password_confirmation' => 'password.111',
        ]);

        $this->seePageIs(route('home'));

        $this->seeInDatabase('users', [
            'name'  => 'Nama User',
            'email' => 'email@mail.com',
        ]);
    }
}
