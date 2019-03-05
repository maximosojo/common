<?php

/*
 * This file is part of the Máximo Sojo - maxtoan package.
 * 
 * (c) https://maxtoan.github.io/common
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Maxtoan\Common\Filesystem;

/**
 * Folder
 * 
 * @author Máximo Sojo <maxsojo13@gmail.com>
 */
abstract class Folder
{
	/**
     * Recursively delete directory from filesystem.
     *
     * @param  string $target
     * @param  bool   $include_target
     * @return bool
     * @throws \RuntimeException
     */
    public static function delete($target, $include_target = true)
    {
        if (!is_dir($target)) {
            return false;
        }

        $success = self::doDelete($target, $include_target);

        if (!$success) {
            $error = error_get_last();
            throw new \RuntimeException($error['message']);
        }

        // Make sure that the change will be detected when caching.
        if ($include_target) {
            @touch(dirname($target));
        } else {
            @touch($target);
        }

        return $success;
    }

    /**
     * @param  string $folder
     * @param  bool   $include_target
     * @return bool
     * @internal
     */
    protected static function doDelete($folder, $include_target = true)
    {
        // Special case for symbolic links.
        if (is_link($folder)) {
            return @unlink($folder);
        }

        // Go through all items in filesystem and recursively remove everything.
        $files = array_diff(scandir($folder, SCANDIR_SORT_NONE), array('.', '..'));
        foreach ($files as $file) {
            $path = "{$folder}/{$file}";
            is_dir($path) ? self::doDelete($path) : @unlink($path);
        }

        return $include_target ? @rmdir($folder) : true;
    }
}