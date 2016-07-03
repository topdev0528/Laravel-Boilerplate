<?php

namespace App\Repositories\Backend\Access\Role;

use App\Models\Access\Role\Role;
use App\Exceptions\GeneralException;

/**
 * Class EloquentRoleRepository
 * @package app\Repositories\Role
 */
class EloquentRoleRepository implements RoleRepositoryContract
{

	/**
     * @param $id
     * @param bool $withPermissions
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     * @throws GeneralException
     */
    public function findOrThrowException($id, $withPermissions = false)
    {
        if ($role = Role::find($id)) {
            if ($withPermissions) {
                $role->load("permissions");
            }

            return $role;
        }

        throw new GeneralException(trans('exceptions.backend.access.roles.not_found'));
    }

	/**
     * @return mixed
     */
    public function getCount() {
        return Role::count();
    }

	/**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getForDataTable() {
        return Role::all();
    }

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @param  bool    $withPermissions
     * @return mixed
     */
    public function getAllRoles($order_by = 'sort', $sort = 'asc', $withPermissions = false)
    {
        if ($withPermissions) {
            return Role::with('permissions')
                ->orderBy($order_by, $sort)
                ->get();
        }

        return Role::orderBy($order_by, $sort)
            ->get();
    }

    /**
     * @param  $input
     * @throws GeneralException
     * @return bool
     */
    public function create($input)
    {
        if (Role::where('name', $input['name'])->first()) {
            throw new GeneralException(trans('exceptions.backend.access.roles.already_exists'));
        }

        //See if the role has all access
        $all = $input['associated-permissions'] == 'all' ? true : false;

        if (! isset($input['permissions']))
            $input['permissions'] = [];

        //This config is only required if all is false
        if (!$all) {
            //See if the role must contain a permission as per config
            if (config('access.roles.role_must_contain_permission') && count($input['permissions']) == 0) {
                throw new GeneralException(trans('exceptions.backend.access.roles.needs_permission'));
            }
        }

        $role       = new Role;
        $role->name = $input['name'];
        $role->sort = isset($input['sort']) && strlen($input['sort']) > 0 && is_numeric($input['sort']) ? (int)$input['sort'] : 0;

        //See if this role has all permissions and set the flag on the role
        $role->all = $all;

        if ($role->save()) {
            if (!$all) {
                $permissions = [];

                if (is_array($input['permissions']) && count($input['permissions'])) {
                    foreach ($input['permissions'] as $perm) {
                        if (is_numeric($perm)) {
                            array_push($permissions, $perm);
                        }
                    }
                }

                $role->attachPermissions($permissions);
            }

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.roles.create_error'));
    }

    /**
     * @param  $id
     * @param  $input
     * @throws GeneralException
     * @return bool
     */
    public function update($id, $input)
    {
        $role = $this->findOrThrowException($id);

        //See if the role has all access, administrator always has all access
        if ($role->id == 1) {
            $all = true;
        } else {
            $all = $input['associated-permissions'] == 'all' ? true : false;
        }

        if (! isset($input['permissions']))
            $input['permissions'] = [];

        //This config is only required if all is false
        if (! $all) {
            //See if the role must contain a permission as per config
            if (config('access.roles.role_must_contain_permission') && count($input['permissions']) == 0) {
                throw new GeneralException(trans('exceptions.backend.access.roles.needs_permission'));
            }
        }

        $role->name = $input['name'];
        $role->sort = isset($input['sort']) && strlen($input['sort']) > 0 && is_numeric($input['sort']) ? (int) $input['sort'] : 0;

        //See if this role has all permissions and set the flag on the role
        $role->all = $all;

        if ($role->save()) {
            //If role has all access detach all permissions because they're not needed
            if ($all) {
                $role->permissions()->sync([]);
            } else {
                //Remove all roles first
                $role->permissions()->sync([]);

                //Attach permissions if the role does not have all access
                $permissions = [];

                if (is_array($input['permissions']) && count($input['permissions'])) {
                    foreach ($input['permissions'] as $perm) {
                        if (is_numeric($perm)) {
                            array_push($permissions, $perm);
                        }
                    }
                }

                $role->attachPermissions($permissions);
            }

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.roles.update_error'));
    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return bool
     */
    public function destroy($id)
    {
        //Would be stupid to delete the administrator role
        if ($id == 1) { //id is 1 because of the seeder
            throw new GeneralException(trans('exceptions.backend.access.roles.cant_delete_admin'));
        }

        $role = $this->findOrThrowException($id);

        //Don't delete the role is there are users associated
        if ($role->users()->count() > 0) {
            throw new GeneralException(trans('exceptions.backend.access.roles.has_users'));
        }

        //Detach all associated roles
        $role->permissions()->sync([]);

        if ($role->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.roles.delete_error'));
    }
}
