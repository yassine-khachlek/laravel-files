<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('files') ) {
            Schema::create('files', function (Blueprint $table) {
                $table->bigIncrements('id');
            });
        }

        Schema::table('files', function (Blueprint $table) {

            if (!Schema::hasColumn($table->getTable(), 'disk')) {
                $table->string('disk', 191)->default('local');
            }

            if (!Schema::hasColumn($table->getTable(), 'name')) {
                $table->string('name', 191);
            }

            if (!Schema::hasColumn($table->getTable(), 'extension')) {
                $table->string('extension', 191);
            }

            if ( ! Schema::hasColumn($table->getTable(), 'size') ) {
                $table->unsignedBigInteger('size')->nullable();
            }

            if ( ! Schema::hasColumn($table->getTable(), 'mime_type') ) {
                $table->string('mime_type', 191)->nullable();
            }

            if ( ! Schema::hasColumn($table->getTable(), 'created_at') ) {
                $table->dateTime('created_at');
            }

            if ( ! Schema::hasColumn($table->getTable(), 'updated_at') ) {
                $table->timestamp('updated_at');
            }

            if ( ! Schema::hasColumn($table->getTable(), 'deleted_at') ) {
                $table->dateTime('deleted_at')->nullable();
            }

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('files');
    }
}
