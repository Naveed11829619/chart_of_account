<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::table('voucher_details', function (Blueprint $table) {
            $table->dropColumn('sub_account_id');
            $table->unsignedBigInteger('final_account_id');
            $table->foreign('final_account_id')->references('id')->on('final_accounts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voucher_details', function (Blueprint $table) {
            $table->dropColumn('sub_account_id');
            $table->unsignedBigInteger('final_account_id');
            $table->foreign('final_account_id')->references('id')->on('final_accounts')->onDelete('cascade')->onUpdate('cascade');
        });
    }
};
