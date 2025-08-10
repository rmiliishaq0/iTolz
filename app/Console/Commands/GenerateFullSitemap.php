<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

// Import all the classes we will need at the top
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\SitemapIndex; // The Sitemap Index class is key
use App\Models\Product;

class GenerateFullSitemap extends Command
{
    protected $signature = 'sitemap:generate-full';
    protected $description = 'Generates a sitemap index with separate files for models and static pages.';

    public function handle()
    {
        $this->info('Starting sitemap generation with the Index method...');

        // --- Part A: Generate the sitemap for your DATABASE Models ---
        // This creates a sitemap containing ONLY your packs and products.
        // It saves it to a specific file named 'sitemap-models.xml'.
        $this->info('Step 1: Generating sitemap for database models...');
        Sitemap::create()
            ->add(Product::all())
            ->writeToFile(public_path('sitemap-models.xml'));
        $this->info('>> sitemap-models.xml created.');


        // --- Part B: Generate the sitemap for your STATIC Pages ---
        // This uses the most basic crawler function to find all your static
        // pages and saves them to a file named 'sitemap-static.xml'.
        // This writeToFile() method has existed for a very long time.
        $this->info('Step 2: Generating sitemap for static pages via crawler...');
        SitemapGenerator::create(config('app.url'))
            ->writeToFile(public_path('sitemap-static.xml'));
        $this->info('>> sitemap-static.xml created.');


        // --- Part C: Create the Main Sitemap Index File ---
        // This is the "table of contents" file. It doesn't contain URLs itself,
        // but instead points to the other sitemap files.
        $this->info('Step 3: Creating the main sitemap index file...');
        SitemapIndex::create()
            ->add('/sitemap-models.xml') // Add the path to the first sitemap
            ->add('/sitemap-static.xml') // Add the path to the second sitemap
            ->writeToFile(public_path('sitemap.xml')); // This creates the final sitemap.xml

        $this->info('✅ Success! Your main sitemap.xml now points to the two generated files.');

        return self::SUCCESS;
    }
}
