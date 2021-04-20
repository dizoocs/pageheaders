<?php namespace Dizoo\PageHeaders\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class static_page_fix extends Migration
{
    public function up()
    {
        Schema::table('dizoo_pageheaders_headers', function($table)
        {
            if (!Schema::hasColumn('dizoo_pageheaders_headers', 'static_page')) $table->boolean('static_page')->default(0);
        });
    }

    public function down()
    {
            Schema::table('dizoo_pageheaders_headers', function($table)
            {
                if (Schema::hasColumn('dizoo_pageheaders_headers', 'static_page')) $table->dropColumn('static_page');
            });
    }
}