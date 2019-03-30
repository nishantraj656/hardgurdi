<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionalPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *CREATE TABLE `section_info_tab` (`section_info_id`,`test_info_id`, `package_id`, `name`, 
     `descrption`, `pic`, `enroll_stud_count`, `price`, `marks_on_correct`,
      `marks_on_incorrect`, `created_at`, `updated_at`, `status`, `expDate`, `time`)
     * @return void
     */
    public function up()
    {
        Schema::create('sectional_packages', function (Blueprint $table) {
            $table->bigIncrements('section_info_id')->primary();
            $table->integer('test_info_id');
            $table->integer('package_id');
            $table->string('name');
            $table->string('descrption')->nullable();
            $table->string('pic')->nullable();
            $table->integer('price');
            $table->integer('marks_on_correct');
            $table->integer('marks_on_incorrect');
            $table->integer('status')->default(0);
            $table->integer('time');
            $table->date('expDate');
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
        Schema::dropIfExists('sectional_packages');
    }
}
