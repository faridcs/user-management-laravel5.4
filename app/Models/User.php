<?php

namespace App\Models;

use App\Presenters\UserPresenter;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laracasts\Presenter\PresentableTrait;
use App\Traits\CustomFieldsTrait;
use Spatie\Activitylog\LogsActivity;
use Spatie\Activitylog\LogsActivityInterface;
use Zizaco\Entrust\Traits\EntrustUserTrait;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $password
 * @property string $avatar
 * @property string $status
 * @property string|null $dob
 * @property string $gender
 * @property string $user_type
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $reset_token
 * @property-read mixed $extras
 * @property-read mixed $gravatar
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereResetToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserType($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements LogsActivityInterface
{
    use EntrustUserTrait;
    use PresentableTrait;
    use CustomFieldsTrait;
    use LogsActivity;

    protected $presenter = UserPresenter::class;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'facebookClientID', 'facebookClientSecret',
        'googleClientID', 'googleClientSecret', 'twitterClientID', 'twitterClientSecret',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'gravatar'
    ];

    public static function getCount($status = null)
    {
        if($status == null){
            return User::count();

        }
        else{
            return User::where('status', $status)->count();
        }
    }

    public function getGravatarAttribute($size= 80, $d = 'mm')
    {
        if($this->avatar === 'default.png'){
            $url = 'https://www.gravatar.com/avatar/' . md5( strtolower( trim( $this->email ) ) ) . '?d='.$d.'&s='. $size;

        }else{
            $url = asset('avatar/'.$this->avatar);
        }

        return $url;
    }

    /**
     * @param $loggedInAdmin
     * @return mixed
     */
    public function unreadChatMessage($loggedInAdmin)
    {
        return UserChat::where('from', $this->id)->where('to', $loggedInAdmin)->where('message_seen', 'no')->count();
    }

    /**
     * @param string $eventName
     * @return string
     */
    public function getActivityDescriptionForEvent($eventName)
    {
        if (\Auth::check()){
            $this->user = \Auth::user()->name;

        }else{
            $this->user = 'Seeder';
        }

        if ($eventName == 'created')
        {
            return $this->user.' created user <strong>'.$this->name.'</strong> successfully';
        }

        if ($eventName == 'updated')
        {
            return $this->user.' updated user <strong>'.$this->name.'</strong> successfully';
        }

        if ($eventName == 'deleted')
        {
            return $this->user.' deleted user <strong>'.$this->name.'</strong> successfully';
        }

        return '';
    }

}
