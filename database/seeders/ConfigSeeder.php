<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ConfigSeeder extends Seeder
{
    protected $defaultImages = [
        'banner_1' => 'homepage1.png',
        'banner_2' => 'homepage2.png',
        'banner_bottom' => 'homepage3.png',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sourceDir = public_path();
        $destDir = 'public/homepage';

        foreach ($this->defaultImages as $key => $filename) {
            $sourcePath = $sourceDir.'/'.$filename;

            // Lấy phần mở rộng từ file nguồn
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $storageFilename = $key.'.'.$extension;
            $storagePath = $destDir.'/'.$storageFilename;

            // Copy nếu file tồn tại
            if (File::exists($sourcePath)) {
                Storage::put($storagePath, File::get($sourcePath));
            }

            Config::updateOrCreate(
                ['key' => $key],
                ['value' => $storagePath]
            );
        }
    }
}
