<?php

namespace App\Models\Admin;

use \Spatie\Permission\Models\Role as PermissionRole;

class Role extends PermissionRole
{
    protected $connection = 'www';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
