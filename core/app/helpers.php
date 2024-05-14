<?php

use App\Models\Upload;

if (!function_exists('my_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    function my_asset($path, $secure = null)
    {
        return app('url')->asset($path, $secure);
    }
}


//return file uploaded via uploader
if (!function_exists('uploaded_asset')) {
    function uploaded_asset($id)
    {
        if (($asset = Upload::find($id)) != null) {
            return my_asset($asset->file_name);
        }
        return null;
    }
}

//return file uploaded via uploader
if (!function_exists('uploaded_asset_name')) {
    function uploaded_asset_name($id)
    {
        if (($asset = Upload::find($id)) != null) {
            return $asset->file_original_name;
        }
        return null;
    }
}

//return file uploaded via uploader
if (!function_exists('uploaded_asset_path')) {
    function uploaded_asset_path($id)
    {
        if (($asset = Upload::find($id)) != null) {
            return asset($asset->file_name);
        }
        return null;
    }
}

if (!function_exists('formatBytes')) {
    function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}