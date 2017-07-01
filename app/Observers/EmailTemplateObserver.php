<?php

namespace App\Observers;

use App\Models\EmailTemplate;

class EmailTemplateObserver
{
    /**
     * Listen to the Permission created event.
     *
     */

    public function __construct()
    {
        if (\Auth::check()){
            $this->emailTemplate = \Auth::user()->name;

        }else{
            $this->emailTemplate = 'Seeder';
        }

    }

    public function updated(EmailTemplate $emailTemplate)
    {
        activity()
            ->performedOn($emailTemplate)
            ->causedBy($emailTemplate)
            ->performedOn($emailTemplate)
            ->log($this->emailTemplate.' updated email template <b>:subject.email_id</b> successfully');
    }
}