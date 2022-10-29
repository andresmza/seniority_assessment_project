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
        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedBigInteger('teacher_id')->nullable()->default(null);
            $table->date('expiration_date')->nullable()->default(null);
            $table->datetime('payment_date')->nullable()->defauit(null);
            $table->boolean('acredited')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('teacher_id');
            $table->dropColumn('expiration_date');
            $table->dropColumn('payment_date');
            $table->dropColumn('acredited');
        });
    }
};
