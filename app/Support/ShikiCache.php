<?php

namespace App\Support;

use Illuminate\Support\Facades\File;

class ShikiCache
{
    protected static string $cacheDir = 'storage/shiki-cache';

    public static function get(string $key): ?string
    {
        $path = self::getPath($key);

        if (File::exists($path)) {
            return File::get($path);
        }

        return null;
    }

    public static function put(string $key, string $value): void
    {
        $path = self::getPath($key);
        $dir = dirname($path);

        if (!File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        File::put($path, $value);
    }

    public static function has(string $key): bool
    {
        return File::exists(self::getPath($key));
    }

    protected static function getPath(string $key): string
    {
        // Use first 2 chars of hash as subdirectory to avoid too many files in one dir
        $hash = md5($key);
        $subdir = substr($hash, 0, 2);

        return base_path(self::$cacheDir . '/' . $subdir . '/' . $hash . '.html');
    }

    public static function getCacheDir(): string
    {
        return base_path(self::$cacheDir);
    }
}
