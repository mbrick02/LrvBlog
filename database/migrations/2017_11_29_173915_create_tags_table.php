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
              $table->increments('id');
              $table->string('name')->unique();
              $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
              $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
              $timestamps = false;
          });

          Schema::create('post_tag', function (Blueprint $table) {
              // not necessary: $table->increments('id');
              $table->integer('post_id');
              $table->integer('tag_id');
              $table->primary(['post_id', 'tag_id']);
              $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
              $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
              $timestamps = false;
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
