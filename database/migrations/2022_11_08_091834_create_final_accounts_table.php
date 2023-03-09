<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->unsignedInteger('level_three_id');
            $table->foreign('level_three_id')->references('id')->on('level_threes')->onDelete('cascade');
            $table->string('title');
            $table->string('opening_balance');
            $table->date('date');
            $table->string('transaction_type');
            $table->unsignedInteger('created_by');
            $table->softDeletes();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE final_accounts MODIFY id INT(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('final_accounts');
    }
};
