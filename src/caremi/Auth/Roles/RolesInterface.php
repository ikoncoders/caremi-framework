<?php declare(strict_types=1);
namespace Caremi\Auth\Roles;

interface RolesInterface
{

    /**
     * This method accepts a permission name and returns true if the user has the
     * permission of false otherwise
     *
     * @param $permissionName
     * @return bool
     */
    public function hasPrivilege($permissionName) : bool;

    /**
     * HasPermission method accepts a permission name and returns the value based on the 
     * current object
     *
     * @param string $permission
     * @return bool
     */
    public function hasPermission($permission) : bool;

    
    /**
     * Check if a user has a specific role
     *
     * @param string $roleName
     * @return boolean
     */
    public function hasRole($roleName) : bool;


}
