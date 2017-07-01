<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factory;

class EmailTemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        \DB::table('email_templates')->delete();

        \DB::statement('ALTER TABLE email_templates AUTO_INCREMENT = 1');
        Model::unguard();

        \DB::beginTransaction();
        \DB::table('email_templates')->delete();

        \DB::table('email_templates')->insert(array(
            0 => array(
                'email_id'   => 'FORGET_PASSWORD',
                'subject'    => 'Reset Password',
                'body'       => 'Dear ##USERNAME##,
Here are your password reset instructions.

A request to reset your Admin password has been made. If you did not make this request, simply ignore this email. If you did make this request, please reset your password
##URL##
If the button above does not work, try copying and pasting the URL into your browser. If you continue to have problems, please feel free to contact us 
',
                'variables'  => '["##USERNAME##", "##URL##"]'
            ),
            1 => array(
                'email_id'   => 'RESET_SUCCESS',
                'subject'    => 'Reset success',
                'body'       => 'Dear ##USERNAME##,
You have successfully reset yours password. Please click the below link to login
##URL##
If the button above does not work, try copying and pasting the URL into your browser. If you continue to have problems, please feel free to contact us
',
                'variables'  => '["##USERNAME##"]'
            ),
            2 => array(
                'email_id'   => 'USER_REGISTRATION',
                'subject'    => 'Register success',
                'body'       => 'Dear ##USERNAME##,
Thank you for registration. Please click the below link to login
##URL##
If the button above does not work, try copying and pasting the URL into your browser. If you continue to have problems, please feel free to contact us 
',
                'variables'  => '["##USERNAME##","##URL##"]',
            ),


        ));
        \DB::commit();
    }

}
