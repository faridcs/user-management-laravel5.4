<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogsActivity;
use Spatie\Activitylog\LogsActivityInterface;

/**
 * App\Models\Setting
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $site_name
 * @property string $logo
 * @property string|null $facebook_client_id
 * @property string|null $facebook_client_secret
 * @property string|null $google_client_id
 * @property string|null $google_client_secret
 * @property string|null $twitter_client_id
 * @property string|null $twitter_client_secret
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $email_notification
 * @property int $recaptcha
 * @property int $remember_me
 * @property int $forget_password
 * @property int $allow_register
 * @property int $email_confirmation
 * @property int $custom_field_on_register
 * @property string $mail_driver
 * @property string $mail_host
 * @property string $mail_port
 * @property string $mail_username
 * @property string $mail_password
 * @property string $mail_encryption
 * @property string $recaptcha_public_key
 * @property string $recaptcha_private_key
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereAllowRegister($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereCustomFieldOnRegister($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereEmailConfirmation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereEmailNotification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereFacebookClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereFacebookClientSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereForgetPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereGoogleClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereGoogleClientSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereMailDriver($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereMailEncryption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereMailHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereMailPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereMailPort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereMailUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereRecaptcha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereRecaptchaPrivateKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereRecaptchaPublicKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereRememberMe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereSiteName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereTwitterClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereTwitterClientSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Setting extends Model  implements LogsActivityInterface
{
    use LogsActivity;

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

        if ($eventName == 'updated')
        {
            return $this->user.' updated <strong>'.\Request::get('setting').'</strong> setting successfully';
        }

        return '';
    }

}
