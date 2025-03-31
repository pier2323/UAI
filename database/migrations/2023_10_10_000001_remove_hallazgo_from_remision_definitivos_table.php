<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveHallazgoFromRemisionDefinitivosTable extends Migration
{
    public function up()
    {
        Schema::table('remision_definitivos', function (Blueprint $table) {
            if (Schema::hasColumn('remision_definitivos', 'hallazgo')) {
                $table->dropColumn('hallazgo');
            }
        });
    }

    public function down()
    {
        Schema::table('remision_definitivos', function (Blueprint $table) {
            $table->text('hallazgo')->nullable();
        });
    }
}
