<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'logo'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->identifier = (string)Uuid::generate(4);
        });
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
