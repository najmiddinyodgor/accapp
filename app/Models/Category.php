<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function notes()
    {
        return $this->hasManyThrough(Note::class, SubCategory::class);
    }

    public function subCats()
    {
        return $this->hasMany(SubCategory::class);
    }
}