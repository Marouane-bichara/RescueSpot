<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreDetailsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            // Adding new columns to the users table
            $table->date('birthday')->nullable();
            $table->string('backgroundProfile')->nullable()->after('profilePhoto');
            $table->string('phone')->nullable()->after('backgroundProfile');
            $table->string('address')->nullable()->after('phone');
            $table->string('city')->nullable()->after('address');
            $table->string('country')->nullable()->after('city');
            $table->text('bio')->nullable()->after('country'); 
            $table->string('relationship_status')->nullable()->after('bio');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //

            $table->dropColumn([
                'birthday',
                'backgroundProfile',
                'phone',
                'address',
                'city',
                'country',
                'bio',
                'relationship_status'
            ]);
        });
    }
}
