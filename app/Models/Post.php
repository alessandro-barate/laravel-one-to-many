<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Qui i campi che vogliamo abilitare al mass update
    // protected $fillable = ['title', 'content', 'slug', 'cover_image'];

    // Qui i campi che non vogliamo abilitare al mass update
    protected $guarded = ['id', 'cover_image'];

    public function type() 
    {
        return $this->belongsTo(Type::class);
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}

