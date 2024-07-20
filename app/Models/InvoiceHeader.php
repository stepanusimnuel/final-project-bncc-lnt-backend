<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceHeader extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function InvoiceDetail() {
        return $this->hasMany(InvoiceDetail::class);
    }
}
