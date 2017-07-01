<?php namespace App\Models;

/**
 * Class UserChat
 *
 * @package App\Models
 * @property int $id
 * @property int $admin_id
 * @property int $user_id
 * @property string $message
 * @property int|null $from
 * @property int|null $to
 * @property string $message_seen
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\User $admin
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserChat whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserChat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserChat whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserChat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserChat whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserChat whereMessageSeen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserChat whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserChat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserChat whereUserId($value)
 * @mixin \Eloquent
 */
class UserChat extends \Eloquent
{
    protected $table = 'users_chat';

    protected $dates = ['created_at', 'updated_at'];

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
