<?php

namespace Tests\Feature\Auth;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_login_and_logout()
    {
        $user = factory(User::class)->create(['name' => 'Nama Member', 'email' => 'email@mail.com']);

        $this->visit(route('login'));

        $this->submitForm(__('Login'), [
            'email'    => 'email@mail.com',
            'password' => 'secret',
        ]);

        $this->seeText('You are logged in as Nama Member!');
        $this->seePageIs(route('home'));
        $this->seeIsAuthenticated();

        $this->post(route('logout'));

        $this->dontSeeIsAuthenticated();
    }

    /** @test */
    public function user_invalid_login()
    {
        $this->visit(route('login'));

        $this->submitForm(__('Login'), [
            'email'    => 'email@mail.com',
            'password' => 'member',
        ]);

        $this->seePageIs(route('login'));
        $this->dontSeeIsAuthenticated();
    }

    /** @test */
    public function unauthenticated_users_are_redirects_to_login_page()
    {
        $this->visit(route('home'));
        $this->seePageIs(route('login'));
    }
}
