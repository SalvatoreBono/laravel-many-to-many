<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            //crea una nuova colonna chiamata type_id
            $table->unsignedBigInteger("type_id")->nullable();
            //$table->foreign("type_id")->references("id")->on("types") = rendo type_id una foreign key e prendo come riferimento l'id della colonna types
            //->onDelete("cascade")= se type viene cancellato, cancello anche i projects
            $table->foreign("type_id")->references("id")->on("types")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            //rimuovo la foreign key
            $table->dropForeign("projects_type_id_foreign");
            //rimuovo la colonna
            $table->dropColumn("type_id");
        });
    }
};
