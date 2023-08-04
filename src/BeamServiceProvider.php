<?php

namespace RayBeam\Beam;

use RayBeam\Beam\Commands\InitializeBeamCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BeamServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('beam')
            ->hasConfigFile()
            ->hasCommands(InitializeBeamCommand::class);
    }
}
