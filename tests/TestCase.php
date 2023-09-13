<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->loadEnvironmentFrom('.env.testing');
        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();


        return $app;
    }

    public function setUp(): void
    {
        parent::setUp();
        dump('---migrating and seeding---');
        $this->artisan('migrate:fresh  --path=database/migrations/');
        $this->artisan('db:seed');
    }

    public function getTokenHeaders(): array
    {
        $user = User::factory()->create([
            'name' => 'ahmed',
            'email' => 'ahmed@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        $response = $this->post('/api/v1/login', [
            'email' => $user->email,
            'password' => '12345678'
        ]);
        $token = json_decode($response->getContent())->data->token;
        return ['Authorization' => 'Bearer' . $token];
    }

}
