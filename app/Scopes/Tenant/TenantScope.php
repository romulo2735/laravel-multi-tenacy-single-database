<?php


namespace App\Scopes\Tenant;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use App\Tenant\ManagerTenant;

class TenantScope implements Scope
{
    /**
     * @param Builder $builder
     * @param Model $model
     */
    public function apply(Builder $builder, Model $model)
    {
        $tenant = app(ManagerTenant::class)->getTenantIdentify();
        $builder->where('tenant_id', $tenant);
    }
}
