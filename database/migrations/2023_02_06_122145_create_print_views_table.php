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
        Schema::create('print_views', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->enum('voucher_type',
            [
                'journal_voucher',
                'cash_payment_voucher',
                'cash_receipt_voucher',
                'bank_payment_voucher',
                'bank_receipt_voucher'
                ])->default('journal_voucher');
            $table->string('total_debit')->default(0);
            $table->string('total_credit')->default(0);
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
        Schema::dropIfExists('print_views');
    }
};
