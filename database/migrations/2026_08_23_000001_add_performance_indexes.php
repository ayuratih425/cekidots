<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('upload_anggota', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('folder_id');
            $table->index('tahun');
            $table->index('status');
        });

        Schema::table('folder_dokumen', function (Blueprint $table) {
            $table->index('divisi');
            $table->index('status');
            $table->index('created_by');
            $table->index('parent_id');
        });

        Schema::table('surat_masuk', function (Blueprint $table) {
            $table->index('status');
        });

        Schema::table('dokumen_akip', function (Blueprint $table) {
            $table->index(['tahun', 'urutan']);
            $table->index('status');
        });

        Schema::table('dokumen_iki', function (Blueprint $table) {
            $table->index(['tahun', 'urutan']);
            $table->index('status');
        });

        Schema::table('sliders', function (Blueprint $table) {
            $table->index(['status', 'urutan']);
        });
    }

    public function down(): void
    {
        Schema::table('upload_anggota', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['folder_id']);
            $table->dropIndex(['tahun']);
            $table->dropIndex(['status']);
        });

        Schema::table('folder_dokumen', function (Blueprint $table) {
            $table->dropIndex(['divisi']);
            $table->dropIndex(['status']);
            $table->dropIndex(['created_by']);
            $table->dropIndex(['parent_id']);
        });

        Schema::table('surat_masuk', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });

        Schema::table('dokumen_akip', function (Blueprint $table) {
            $table->dropIndex(['tahun', 'urutan']);
            $table->dropIndex(['status']);
        });

        Schema::table('dokumen_iki', function (Blueprint $table) {
            $table->dropIndex(['tahun', 'urutan']);
            $table->dropIndex(['status']);
        });

        Schema::table('sliders', function (Blueprint $table) {
            $table->dropIndex(['status', 'urutan']);
        });
    }
};
