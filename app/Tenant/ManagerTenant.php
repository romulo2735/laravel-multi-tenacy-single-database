<?php


namespace App\Tenant;


class ManagerTenant
{
    /**
     * Retorna o id do Tenant.
     * @return mixed
     */
    public function getTenantIdentify()
    {
        return auth()->user()->tenant->id;
    }
}
