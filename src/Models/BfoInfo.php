<?php

namespace Totaa\TotaaBfo\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Spatie\Permission\Traits\HasRoles;

class BfoInfo extends Model implements AuthorizableContract
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;
    use Authorizable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mnv', 'full_name', 'name', 'birthday', 'ngay_vao_lam', 'active',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bfo_infos';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'mnv';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'birthday' => 'datetime',
        'ngay_vao_lam' => 'datetime',
    ];

    /**
     * guard_name
     *
     * @var string
     */
    protected $guard_name = 'web';

    /*Liên kết với tài khoản*/
    public function users()
    {
         return $this->hasMany('App\Models\User', 'info_mnv', 'mnv');
    }
}
