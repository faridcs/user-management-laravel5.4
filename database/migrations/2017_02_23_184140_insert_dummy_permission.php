<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertDummyPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {

        DB::table('permissions')->insert([
            ['name' => 'permission1', 'display_name' => 'permission1', 'description' => 'description1'],
            ['name' => 'permission2', 'display_name' => 'permission2', 'description' => 'description2'],
            ['name' => 'permission3', 'display_name' => 'permission3', 'description' => 'description3'],
            ['name' => 'permission4', 'display_name' => 'permission4', 'description' => 'description4'],
            ['name' => 'permission5', 'display_name' => 'permission5', 'description' => 'description5'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }

}
