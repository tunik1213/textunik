<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Votes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('articles', function (Blueprint $table) {
            DB::statement('ALTER TABLE `articles` CHANGE COLUMN `updated_at` `updated_at` DATETIME NOT NULL DEFAULT NOW();');

            $table->integer('votes_up')->default(0);
            $table->integer('votes_down')->default(0);
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->integer('votes_up')->default(0);
            $table->integer('votes_down')->default(0);
        });

        Schema::create('article_votes', function (Blueprint $table) {
            $table->id();
            $table->integer('article_id');
            $table->integer('author_id');
            $table->integer('value');
            $table->index(['article_id', 'author_id']);
            $table->timestamps();
        });

        Schema::create('comment_votes', function (Blueprint $table) {
            $table->id();
            $table->integer('comment_id');
            $table->integer('author_id');
            $table->integer('value');
            $table->index(['comment_id', 'author_id']);
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
        Schema::drop('article_votes');
        Schema::drop('comment_votes');

        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('votes_up');
            $table->dropColumn('votes_down');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('votes_up');
            $table->dropColumn('votes_down');
        });
    }
}
