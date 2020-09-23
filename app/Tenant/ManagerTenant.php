<?php


namespace App\Tenant;


use App\Models\Tenant;

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

    /**
     * Retorna objeto de Tenant do usuário.
     * @return Tenant
     */
    public function getTenant() : Tenant
    {
        return auth()->user()->tenant;
    }
}
