<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = [
        'title', 'body', 'image', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
