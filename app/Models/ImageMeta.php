<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageMeta extends Model
{
    protected $table = 'image_meta';

    protected $fillable = ['rel_path', 'alt_text', 'alt_text_suggestion'];
}
