<?php

namespace App;

use Spatie\Activitylog\LogsActivity;
use Spatie\Activitylog\LogsActivityInterface;
use Zizaco\Entrust\EntrustRole;

/**
 * App\Role
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Permission[] $perms
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Role extends EntrustRole implements LogsActivityInterface
{
    use LogsActivity;

    /**
     * @return mixed
     */

    public static function getCount()
    {
        return Role::count();
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
            return $this->user.' created role <strong>'.$this->name.'</strong> successfully';
        }

        if ($eventName == 'updated')
        {
            return $this->user.' updated role <strong>'.$this->name.'</strong> successfully';
        }

        if ($eventName == 'deleted')
        {
            return $this->user.' deleted role <strong>'.$this->name.'</strong> successfully';
        }

        return '';
    }

}
