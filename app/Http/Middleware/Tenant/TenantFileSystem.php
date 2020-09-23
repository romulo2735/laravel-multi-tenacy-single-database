<?php

namespace App\Http\Middleware\Tenant;

use App\Tenant\ManagerTenant;
use Closure;
use Illuminate\Http\Request;

class TenantFileSystem
{
    /**
     * Middleware responsavel por automatizar o envio de arquivos de acordo com o Tenant.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // verifica se o usuário está logado.
        if (auth()->check()) {
            $this->setFilesystemRoot();
        }

        return $next($request);
    }

    public function setFilesystemRoot()
    {
        $tenant = app(ManagerTenant::class)->getTenant();

        // acessando o drive se arquivos.
        config()->set(
            'filesystems.disks.tenant.root',
            config('filesystems.disks.tenant.root') . "/{$tenant->identifier}"
        );
    }
}
