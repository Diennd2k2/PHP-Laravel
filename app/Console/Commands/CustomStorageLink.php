<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CustomStorageLink extends Command
{
    protected $signature = 'storage:custom-link';
    protected $description = 'Create custom symbolic links for storage';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $links = [
            public_path('storage') => base_path('storage/app/public')
        ];

        foreach ($links as $link => $target) {
            if (File::exists($link)) {
                $this->info("Removing existing [{$link}] link.");
                File::delete($link);
            }

            $this->info("Creating link from [{$link}] to [{$target}].");
            File::link($target, $link);
        }

        $this->info('The directories have been linked.');
    }
}
