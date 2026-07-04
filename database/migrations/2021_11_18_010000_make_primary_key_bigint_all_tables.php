<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE igniter_reviews ALTER COLUMN review_id TYPE bigint USING review_id::bigint');
            DB::statement('ALTER TABLE igniter_reviews ALTER COLUMN customer_id TYPE bigint USING customer_id::bigint, ALTER COLUMN customer_id DROP NOT NULL');
            DB::statement('ALTER TABLE igniter_reviews ALTER COLUMN sale_id TYPE bigint USING sale_id::bigint, ALTER COLUMN sale_id DROP NOT NULL');
            DB::statement('ALTER TABLE igniter_reviews ALTER COLUMN location_id TYPE bigint USING location_id::bigint, ALTER COLUMN location_id DROP NOT NULL');
        } else {
            Schema::table('igniter_reviews', function(Blueprint $table): void {
                $table->unsignedBigInteger('review_id', true)->change();
                $table->unsignedBigInteger('customer_id')->nullable()->change();
                $table->unsignedBigInteger('sale_id')->nullable()->change();
                $table->unsignedBigInteger('location_id')->nullable()->change();
            });
        }
    }

    public function down(): void {}
};
