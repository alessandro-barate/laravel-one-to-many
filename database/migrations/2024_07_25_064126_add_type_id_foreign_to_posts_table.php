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
        Schema::table('posts', function (Blueprint $table) {
            
            // Creo il campo
            $table->unsignedBigInteger('type_id')->nullable()->after('id');

            // Creo la chiave esterna
            $table->foreign('type_id')
                ->references('id')
                ->on('types')
                ->nullOnDelete();

            // Modalità compatta della stessa istruzione di sopra
            // $table->foreignId('type_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {

            // Cancello il vincolo tra le tabelle
            $table->dropForeign('posts_type_id_foreign');

            // Cancello il campo
            $table->dropColumn('type_id');
        });
    }
};
