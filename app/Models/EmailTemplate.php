<?php

namespace App\Models;;

use Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\MailServiceProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Spatie\Activitylog\LogsActivity;
use Spatie\Activitylog\LogsActivityInterface;

/**
 * App\Models\EmailTemplate
 *
 * @property int $id
 * @property string $email_id
 * @property string $subject
 * @property string $body
 * @property string $variables
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailTemplate whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailTemplate whereEmailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailTemplate whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailTemplate whereVariables($value)
 * @mixin \Eloquent
 */
class EmailTemplate extends Model implements LogsActivityInterface
{
    use LogsActivity;
    public $table = 'email_templates';

    /**
     * @param $emailId
     * @return mixed
     */

    public static function getEmailTemplate($emailId)
    {
        return EmailTemplate::where('email_id', $emailId)->first();
    }

    /**
     * @param $emailId
     * @return mixed
     */
    public static function emailVariables($emailId)
    {
        $variables = EmailTemplate::where('email_id', $emailId)->first()->variables;
        return $variables;

    }

    public static function prepareAndSendEmail($emailId,$emailInfo,$fieldValues, $throw = false)
    {

        $template  = EmailTemplate::getEmailTemplate($emailId);
        $emailText = $template->body;

        foreach ($fieldValues as $key => $value) {
            $emailText = str_replace('##' . $key . '##', $value, $emailText);
        }

        $setting = Setting::first()->toArray();
        self::setSmtpSettings();

        try {

            \Mail::send('emails.layout', [
                'body'     => nl2br($emailText),
                'setting' => $setting,
            ], function ($message) use ($emailInfo, $throw, $setting, $template) {
                $message->from($setting['email'], $setting['name']);
                $message->to($emailInfo['to'], $emailInfo['toName'])->subject($template['subject']);
            });
        } catch (\Exception $e) {
            if (env('APP_ENV') !== 'production') {
                die('Error sending mail: ' . $e->getMessage() . '\nData: ' . json_encode($emailInfo));
            }

            \Log::error('Error sending mail: ' . $e->getMessage() . '\nData: ' . json_encode($emailInfo));

            if ($throw) {
                return 'Mail not sent Due to Connection Problem';
            }
        }

    }

    public static function setSmtpSettings()
    {
        $smtpSetting = Setting::first();
        
        Config::set('mail.driver', $smtpSetting->smtp_mail_driver);
        Config::set('mail.host', $smtpSetting->smtp_mail_host);
        Config::set('mail.port', $smtpSetting->smtp_mail_port);
        Config::set('mail.username', $smtpSetting->smtp_mail_username);
        Config::set('mail.password', $smtpSetting->smtp_mail_password);
        Config::set('mail.encryption', $smtpSetting->smtp_mail_encryption);
        (new MailServiceProvider(app()))->register();
    }

    /**
     * @param string $eventName
     * @return string
     */
    public function getActivityDescriptionForEvent($eventName)
    {
        if (\Auth::check()){
            $this->emailTemplate = \Auth::user()->name;

        }else{
            $this->emailTemplate = 'Seeder';
        }

        if ($eventName == 'updated')
        {
            return $this->emailTemplate.' updated email template <strong>'.$this->email_id.'</strong> successfully';
        }

        return '';
    }

}
