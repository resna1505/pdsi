<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQCategory extends Model
{
    use HasFactory;
    public function items()
    {
        return $this->hasMany(FAQItem::class, 'faq_category_id'); // foreignKey harus benar
    }
}
