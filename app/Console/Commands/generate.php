<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Collection;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class generate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $location = './Eleventy/src/';
        $collections = Collection::with('posts')->get();
        foreach ($collections as $collection) {
            if (!file_exists($location . $collection->name)) {
                // Create the directory
                mkdir($location . $collection->name, 0755, true);
            }
            // Iterate through each post and create a Markdown file
            foreach ($collection->posts as $post) {
                // Prepare Markdown content
                $markdownContent = $post->content;

                // Generate file name
                $fileName = Str::slug($post->title) . '.md'; // You may need to adjust the file name generation method

                // Save Markdown content to file
                file_put_contents($location . $collection->name . '/' . $fileName, $markdownContent);
            }
        }

        $this->info('Markdown files generated successfully.');

        return 0;
    }
}
