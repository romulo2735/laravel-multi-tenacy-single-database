<?php

namespace App\Models;

use App\Observers\TenantObserver;
use App\Scopes\Tenant\TenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'body'
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new TenantScope);
        static::observe(new TenantObserver);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
