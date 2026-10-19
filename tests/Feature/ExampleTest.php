<?php

test('početna strana vodi na početnu stranu modula', function () {
    $this->get(route('home'))
        ->assertRedirect(config('legacy.home'));
});
