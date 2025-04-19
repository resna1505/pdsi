<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQItem extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(FAQCategory::class, 'faq_category_id'); // foreignKey harus sesuai
    }
}
