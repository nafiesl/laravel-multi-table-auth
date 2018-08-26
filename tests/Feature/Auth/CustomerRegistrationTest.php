<?php

namespace Tests\Feature\Controllers\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CustomerRegistrationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function new_customer_can_register()
    {
        $this->visit(route('customer.register'));

        $this->submitForm(__('Register'), [
            'name'                  => 'Nama Customer',
            'email'                 => 'email@mail.com',
            'password'              => 'password.111',
            'password_confirmation' => 'password.111',
        ]);

        $this->seePageIs(route('customer.home'));

        $this->seeInDatabase('customers', [
            'name'  => 'Nama Customer',
            'email' => 'email@mail.com',
        ]);
    }
}
