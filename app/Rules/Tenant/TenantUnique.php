<?php

namespace App\Rules\Tenant;

use App\Tenant\ManagerTenant;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class TenantUnique implements Rule
{
    private $table, $column, $columnValue;

    /**
     * Create a new rule instance.
     *
     * @param int $column valor da columa do banco de dados
     * @param int $columnValue valor recebido do formulário
     *
     * @return void
     */
    public function __construct($table, $columnValue = null, $column = 'id')
    {
        $this->table = $table;
        $this->column = $column;
        $this->columnValue = $columnValue;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $tenant = app(ManagerTenant::class)->getTenantIdentify();

        $query = DB::table($this->table)
            ->where($attribute, $value)
            ->where('tenant_id', $tenant)
            ->first();

        if ($query && $query->{$this->column} == $this->columnValue) {
            return true;
        }
        return is_null($query);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O valor já existe.';
    }
}
