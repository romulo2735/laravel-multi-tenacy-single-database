<?php


namespace App\Tenant\Traits;


use App\Observers\TenantObserver;
use App\Scopes\Tenant\TenantScope;

trait TenantTrait
{

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new TenantScope);
        static::observe(new TenantObserver);
    }
}
