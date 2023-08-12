<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Laravel\Sanctum\HasApiTokens;
// use Spatie\Permission\Traits\HasRoles;
// use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'phone',
        'address',
        'avatar',
        // 'is_wholesale',
        'gender',
        'verification_token'
    ];

    protected $table = 'users';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const STATUS_ACTIVE = 2;
    const STATUS_DEFAULT = 1;
    const STATUS_CANCEL = -1;

    const ROLE_ADMIN = 'ADMIN';
    const ROLE_USER = 'USER';

    protected $setStatus = [
        self::STATUS_DEFAULT => [
            'name' => 'Chờ kích hoạt',
            'class' => 'badge badge-light'
        ],
        self::STATUS_CANCEL => [
            'name' => 'Khoá/ Block',
            'class' => 'badge badge-danger'
        ],
        self::STATUS_ACTIVE => [
            'name' => 'Hoạt động',
            'class' => 'badge badge-primary'
        ],
    ];

    public function getStatus()
    {
        return Arr::get($this->setStatus, $this->status, []);
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'user_id');
    }

    public function articleActions()
    {
        return $this->hasMany(ArticleAction::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function pets()
    {
        return $this->hasMany(Pet::class, 'user_id');
    }

    public function petActions()
    {
        return $this->hasMany(PetAction::class, 'user_id');
    }

    public function userType()
    {
        return $this->belongsToMany(UserType::class,'users_has_types','user_id','user_type_id');
    }

    public function userHasTypes()
    {
        return $this->hasMany(UserHasType::class, 'user_id');
    }

    public function userFollows()
    {
        return $this->hasMany(UserFollow::class, 'user_id');
    }

    public function notificationsSent()
    {
        return $this->hasMany(Notification::class, 'user_id_nguon', 'id');
    }

    public function notificationsReceived()
    {
        return $this->hasMany(Notification::class, 'user_id_dich', 'id');
    }

    public static function boot()
    {
        parent::boot();

        // Role::macro('hasRole', function ($role) {
        //     return true; // Giả sử bạn luôn trả về true để không sử dụng bảng model_has_roles
        // });

        static::deleting(function ($user) {
            $user->articles()->delete();
            $user->articleActions()->delete();
            $user->comments()->delete();
            $user->pets()->delete();
            $user->petActions()->delete();
            $user->userHasTypes()->delete();
            $user->userFollows()->delete();
            $user->notificationsSent()->delete();
            $user->notificationsReceived()->delete();
        });
    }
}
