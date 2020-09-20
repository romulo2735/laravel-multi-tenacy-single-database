<?php

namespace App\Observers;

use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Model;

class TenantObserver
{
    /**
     * @param Model $model
     */
    public function creating(Model $model)
    {
        $tenant = app(ManagerTenant::class)->getTenantIdentify();
        $model->setAttribute('tenant_id', $tenant);
    }
}
