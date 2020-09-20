<?php

namespace App\Observers;

use App\Models\Tenant;
use App\Tenant\ManagerTenant;

class TenantObserver
{
    /**
     * Handle the tenant "created" event.
     *
     * @param Tenant $model
     * @return void
     */
    public function created(Tenant $model)
    {
        $tenant = app(ManagerTenant::class)->getTenantIdentify();
        $model->setAttribute('tenant_id', $tenant->id);
    }

    /**
     * Handle the tenant "updated" event.
     *
     * @param Tenant $model
     * @return void
     */
    public function updated(Tenant $model)
    {
        //
    }

    /**
     * Handle the tenant "deleted" event.
     *
     * @param Tenant $model
     * @return void
     */
    public function deleted(Tenant $model)
    {
        //
    }

    /**
     * Handle the tenant "restored" event.
     *
     * @param Tenant $model
     * @return void
     */
    public function restored(Tenant $model)
    {
        //
    }

    /**
     * Handle the tenant "force deleted" event.
     *
     * @param Tenant $model
     * @return void
     */
    public function forceDeleted(Tenant $model)
    {
        //
    }
}
