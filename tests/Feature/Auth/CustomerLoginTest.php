<?php

namespace Tests\Feature\Auth;

use App\Customer;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CustomerLoginTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function customer_can_login_and_logout()
    {
        $customer = factory(Customer::class)->create(['name' => 'Nama Member', 'email' => 'email@mail.com']);

        $this->visit(route('customer.login'));

        $this->submitForm(__('Login'), [
            'email'    => 'email@mail.com',
            'password' => 'secret',
        ]);

        $this->seeText('You are logged in!');
        $this->seePageIs(route('customer.home'));
        $this->seeIsAuthenticated('customer');

        $this->post(route('customer.logout'));
        $this->assertRedirectedTo(route('customer.login'));

        $this->dontSeeIsAuthenticated('customer');
    }

    /** @test */
    public function customer_invalid_login()
    {
        $this->visit(route('customer.login'));

        $this->submitForm(__('Login'), [
            'email'    => 'email@mail.com',
            'password' => 'member',
        ]);

        $this->seePageIs(route('customer.login'));
        $this->dontSeeIsAuthenticated('customer');
    }

    /** @test */
    public function unauthenticated_customers_are_redirects_to_login_page()
    {
        $this->visit(route('customer.home'));
        $this->seePageIs(route('customer.login'));
    }
}
