<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubPermission extends Model
{
    const
        OP_CREATE = 1,
        OP_READ = 2,
        OP_UPDATE = 3,
        OP_DELETE = 4,
        OP_F_DELETE = 6;

    public static $crudOperations = [
        self::OP_CREATE => 'Ekleme',
        self::OP_READ => 'Görüntüleme',
        self::OP_UPDATE => 'Güncelleme',
        self::OP_DELETE => 'Silme',
        self::OP_F_DELETE => 'Kalıcı Silme',
    ];

    protected $table = 'permission_sub';
    use HasFactory;

    protected $fillable = [
        'permission_id',
        'permission_sub_id'
    ];

    public $timestamps = false;

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }


    public function checkPermissions($crud = 'read')
    {

        $permission = $this->permission;




    }


}
