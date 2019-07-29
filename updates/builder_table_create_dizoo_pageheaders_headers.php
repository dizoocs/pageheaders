<?php namespace Dizoo\PageHeaders\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateDizooPageheadersHeaders extends Migration
{
    public function up()
    {
        Schema::create('dizoo_pageheaders_headers', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('pageid', 255);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('dizoo_pageheaders_headers');
    }
}
