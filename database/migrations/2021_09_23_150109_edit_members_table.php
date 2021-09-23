<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->date('birth_date')->nullable()->change(); 
            $table->string('birth_place')->nullable()->change(); 
            $table->string('city')->nullable()->change(); 
            $table->string('address')->nullable()->change(); 
            $table->string('civic_number')->nullable()->change(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->date('birth_date')->nullable(false)->change(); 
            $table->string('birth_place')->nullable(false)->change(); 
            $table->string('city')->nullable(false)->change(); 
            $table->string('address')->nullable(false)->change(); 
            $table->string('civic_number')->nullable(false)->change(); 
        });
    }
}
