<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        //Imenovanje pivot tablice ide po abaecednom redu u jednini odijeljene sa "_" - u ovom slučaju tablica post + tag tablica
        //https://laravel.com/docs/5.8/eloquent-relationships#updating-many-to-many-relationships
        Schema::create('post_tag', function (Blueprint $table) {
            $table->integer('post_id');
            $table->integer('tag_id');
            $table->primary(['post_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('post_tag');

    }
}
