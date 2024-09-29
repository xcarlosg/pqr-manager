<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class registers_users_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            $sql = "INSERT INTO users (user_identification, user_name, user_lastname, user_email, verified_email, user_password, user_rol, created_at, updated_at)
                    VALUES 
                        ('456789123', 'Alice', 'Johnson', 'alice.johnson@example.com', NULL, '" . bcrypt('password789') . "', 'user', NOW(), NOW()),
                        ('321654987', 'Bob', 'Brown', 'bob.brown@example.com', NULL, '" . bcrypt('password101') . "', 'user', NOW(), NOW()),       
                        ('654789321', 'Charlie', 'Davis', 'charlie.davis@example.com', NULL, '" . bcrypt('password202') . "', 'user', NOW(), NOW());";
    
            DB::statement($sql);
        }
    }
}
