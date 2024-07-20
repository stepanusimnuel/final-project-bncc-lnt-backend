<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Toy;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function toys() {
        return $this->hasMany(Toy::class);
    }
}
