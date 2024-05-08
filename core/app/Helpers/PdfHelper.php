<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class PdfHelper
{
    public static function handleUploadedPdf($file, $path, $delete = null)
    {
        if ($file) {
            if ($delete) {
                if (file_exists(base_path('../') . $path . '/' . $delete)) {
                    unlink(base_path('../') . $path . '/' . $delete);
                }
            }
            $name = Str::random(4) . $file->getClientOriginalName();
            $file->move($path, $name);
            return $name;
        }
    }

    public static function handleUpdatedUploadedPdf($file, $path, $data, $delete_path, $field)
    {
        $name = time() . $file->getClientOriginalName();

        $file->move(base_path('..') . $path, $name);

        if ($data[$field] != null) {
            if (file_exists(base_path('../') . $delete_path . $data[$field])) {
                unlink(base_path('../') . $delete_path . $data[$field]);
            }
        }
        return $name;
    }

    public static function handleDeletedPdf($data, $field, $delete_path)
    {
        if ($data[$field] != null) {
            if (file_exists(base_path('../') . $delete_path . $data[$field])) {
                unlink(base_path('../') . $delete_path . $data[$field]);
            }
        }
    }
}