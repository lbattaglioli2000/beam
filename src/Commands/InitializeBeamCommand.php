<?php

namespace RayBeam\Beam\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class InitializeBeamCommand extends Command
{
    public $signature = 'beam:init';

    public $description = 'Sets up the Beam package for use in your Laravel application.';

    public function handle(): int
    {
        $email = $this->ask('Email Address');
        $password = $this->secret('Password');

        $token = $this->login($email, $password);
        ray($token);

        if (! $token) {
            $this->error('Unable to log into Beam. Please try again!');

            return self::FAILURE;
        }

        file_put_contents(
            base_path('.env'),
            PHP_EOL."BEAM_API_TOKEN=$token".PHP_EOL,
            FILE_APPEND
        );

        $projects = collect(Http::withToken($token)->get('http://beam.test/api/v1/projects')->json());
        if ($projects->isEmpty()) {
            $this->info('You have no projects!');
            $this->line('You can create a new project at any point from the Beam dashboard. Once you have created a project, you can run this command again to select it.');

            return self::SUCCESS;
        }
        $projectId = $this->selectProjectId($projects);

        // Get all the User's Projects
        // $projects = collect(Http::withToken($token)->get('/api/projects')->json());

        // If the User has no Projects, exit
        // if ($projects->isEmpty()) {
        //    $this->error('You have no projects!');
        //    $create = $this->confirm('Would you like to create a project?');

        //    if (! $create) {
        //        $this->info('You can create a new project at any point from the Beam dashboard.');
        //        return self::SUCCESS;
        //    }
        // }

        return self::SUCCESS;
    }

    private function login(string $email, string $password): string|false
    {
        $response = Http::acceptJson()
            ->post('http://beam.test/api/v1/login', [
                'email' => $email,
                'password' => $password,
                'device_id' => 'Artisan CLI',
            ]);

        ray($response->json());

        if ($response->created()) {
            return $response->json('token');
        }

        return false;
    }

    private function selectProjectId(Collection $projects): string
    {
        $project = $this->choice('Select a project', $projects->pluck('id')->toArray());

        return $projects->firstWhere('name', $project)['id'];
    }
}
