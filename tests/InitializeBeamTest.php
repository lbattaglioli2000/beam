<?php

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;

/**
 * @var TestCase $this
 */

it('can login to Beam API', function () {
    file_put_contents(base_path('.env'), null);

    $this
        ->artisan('beam:init')
        ->expectsQuestion('Email Address', 'him@theluigi.com')
        ->expectsQuestion('Password', 'password');

    $this->assertNotEmpty(Env::get('BEAM_API_TOKEN'));
});

//it('can select a project', function () {
//    $this->artisan('beam:init')
//        ->expectsQuestion('What is your Beam API token?', 'testing123')
//        ->expectsChoice('');
//});
