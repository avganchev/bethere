<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->string('uri')->unique();
            $table->longText('description')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('source_url')->nullable();
            $table->string('status', 1);
            $table->double('price', 8, 2)->nullable();
            $table->string('currency', 3)->default('UAH')->nullable();
            $table->tinyInteger('e_free')->default(0);
            $table->tinyInteger('e_online')->default(0);

            # event, blog post, etc.
            $table->string('type', 1)->default(0);
            $table->string('image');
            $table->integer('comments_count')->default(0);
            $table->integer('likes_count')->default(0);
            $table->string('start_time');
            $table->string('end_time')->nullable();
            $table->string('start_date');
            $table->string('end_date')->nullable();

            # timestamps
            $table->timestamps();
            $table->timestamp('published_at')->nullable();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
