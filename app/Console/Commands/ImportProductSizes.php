<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportProductSizes extends Command
{
    protected $signature = 'import:product-sizes';

    protected $description = 'Import product sizes from SQLite backup';

    public function handle()
    {
        $sqlitePath = 'E:/OUTFIT-Backup/database-2026-06-04.sqlite';
        $sqlite = new \PDO("sqlite:$sqlitePath");

        $this->info('Opening SQLite...');
        $sqlite = new \PDO("sqlite:$sqlitePath");
        $this->info('SQLite connected');

        $sizes = $sqlite->query("
            SELECT product_id, size
            FROM product_sizes
        ")->fetchAll(\PDO::FETCH_ASSOC);

        $this->info('Found ' . count($sizes) . ' sizes');

        $count = 0;

        foreach ($sizes as $size) {

            DB::table('product_sizes')->updateOrInsert(
                [
                    'product_id' => $size['product_id'],
                    'size' => $size['size'],
                ],
                [
                    'updated_at' => now(),
                ]
            );

            $count++;
        }

        $this->info("Imported {$count} product sizes.");
    }
}
