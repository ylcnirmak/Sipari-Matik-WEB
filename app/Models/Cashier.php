<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Cashier extends Model
{
    protected $fillable = ['restaurant_id', 'name', 'password', 'is_active'];
    protected $hidden = ['password'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    // Permissions ilişkisi
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'staff_permissions');
    }

    // Yetki kontrol metodları
    public function hasPermission($permissionName)
    {
        return $this->permissions()->where('name', $permissionName)->exists();
    }

    public function hasAnyPermission($permissions)
    {
        return $this->permissions()->whereIn('name', $permissions)->exists();
    }

    public function hasAllPermissions($permissions)
    {
        return $this->permissions()->whereIn('name', $permissions)->count() === count($permissions);
    }

    // Yetki verme/alma metodları
    public function givePermission($permissionName)
    {
        $permission = Permission::where('name', $permissionName)->first();
        if ($permission && !$this->hasPermission($permissionName)) {
            $this->permissions()->attach($permission->id);
        }
        return $this;
    }

    public function revokePermission($permissionName)
    {
        $permission = Permission::where('name', $permissionName)->first();
        if ($permission) {
            $this->permissions()->detach($permission->id);
        }
        return $this;
    }

    public function revokeAllPermissions()
    {
        $this->permissions()->detach();
        return $this;
    }

    // Yetki kontrolü için can() metodu (Laravel'in can() metoduyla uyumlu)
    public function can($permissionName)
    {
        return $this->hasPermission($permissionName);
    }
}