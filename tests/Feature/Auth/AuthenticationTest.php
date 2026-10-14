<?php

use App\Models\User;
use Illuminate\Support\Facades\Config;

test('users can logout', function () {
    Config::set('legacy.kancelarko_url', 'https://kancelarko.test');
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('logout'));

    $response->assertRedirect('https://kancelarko.test/logout');

    $this->assertGuest();
});
