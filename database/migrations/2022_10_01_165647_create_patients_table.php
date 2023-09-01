<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('patient_first_name', 255);
            $table->string('patient_last_name', 255);
            $table->string('patient_email', 255)->unique();
            $table->date('patient_dob');
            $table->enum('patient_gender', ['M', 'F', 'OTHER'])->default('M');
            $table->string('password');
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('state_id')->unsigned();
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('zip_code_id')->unsigned();
            $table->foreign('zip_code_id')->references('id')->on('zip_codes')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade')->onUpdate('cascade');
            $table->string('patient_phone', 10);
            $table->text('address1')->nullable();
            $table->text('apartment')->nullable();
            $table->integer('language_id')->unsigned();
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade')->onUpdate('cascade');
            $table->datetime('last_login')->nullable();
            $table->enum('login_enable', [1, 0])->default(1);
            $table->enum('is_verified', [1, 0])->default(1);
            $table->enum('fpwd_flag', [1, 0])->default(0);
            $table->enum('sms_notification', [1, 0])->default(1);
            $table->enum('email_notification', [1, 0])->default(1);
            $table->enum('whatsapp_notification', [1, 0])->default(1);
            $table->enum('fcm_notification', [1, 0])->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->longText('mkey')->nullable();
            $table->longText('msalt')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->longText('admin_remark')->nullable();
            $table->enum('status', [1, 0])->default(1);
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
