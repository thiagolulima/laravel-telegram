<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelegramMensagemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telegram_mensagems', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('user_telegram_id');
            $table->string('mensagem')->nullable();
            $table->string('respondida',1)->default('N');
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
        Schema::dropIfExists('telegram_mensagems');
    }
}
