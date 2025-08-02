<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'display_name'];

    public function cashiers()
    {
        return $this->belongsToMany(Cashier::class, 'staff_permissions');
    }
}