<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTableAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->uuid('uid_address')->primary()->index();
            $table->string('zip_code')->index()->nullable(false);
            $table->string('street')->index()->nullable(false);
            $table->string('city')->index()->nullable(false);
            $table->string('district')->index()->nullable(false);
            $table->string('number')->nullable(false);
            $table->string('complement')->index()->nullable(true);
            $table->string('uf')->index()->nullable(false);

            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address');
    }
}
