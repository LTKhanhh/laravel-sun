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
        Schema::table('users', function (Blueprint $table) {
            // Thêm các cột mới
            $table->string('first_name')->after('name');
            $table->string('last_name')->after('first_name');
            $table->string('phone')->nullable()->after('email');
            $table->date('date_of_birth')->nullable()->after('phone');
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('date_of_birth');
            $table->text('address')->nullable()->after('gender');
            $table->string('avatar')->nullable()->after('address');
            $table->enum('role', ['admin', 'manager', 'user'])->default('user')->after('address');
            
            // Modify existing columns
            $table->string('name')->nullable()->change(); // Make name nullable since we have first_name, last_name
            
            // Add indexes
            $table->index('role');
            $table->index(['first_name', 'last_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'last_name', 
                'phone',
                'date_of_birth',
                'gender',
                'address',
                'avatar',
                'role',
            ]);
            
            $table->string('name')->nullable(false)->change();
            
            $table->dropIndex(['users_role_index']);
            $table->dropIndex(['users_first_name_last_name_index']);
        });
    }
};