<?php


namespace App\Http\Filters;


use App\Models\UserRole;

class UserFilter extends Filter
{
    /**
     * @param string|null $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function name(string $value = null)
    {
        return $this->builder->where('name', 'like', "%{$value}%");
    }
}
