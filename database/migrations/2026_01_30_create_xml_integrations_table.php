<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('xml_integrations', function (Blueprint $table) {
            $table->id();
            $table->integer('sequence')->nullable(); // Sequência para SQL Server
            $table->string('sku')->index(); // SKU do item
            $table->string('variant')->default('00000'); // Variante do item
            $table->text('description'); // Descrição do item
            $table->string('base_qty_unit')->default('PCS'); // Unidade de medida
            $table->longText('xml_content'); // Armazena o XML gerado
            $table->enum('status', ['pending', 'sent', 'failed'])->default('pending');
            $table->string('record_type')->default('WLSITEM001');
            $table->string('client_id')->default('BRUNO');
        });

        // Adicionar colunas de datetime com DEFAULT GETDATE() do SQL Server
        DB::statement("ALTER TABLE xml_integrations ADD created_at DATETIME DEFAULT GETDATE()");
        DB::statement("ALTER TABLE xml_integrations ADD updated_at DATETIME DEFAULT GETDATE()");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('xml_integrations');
    }
};

