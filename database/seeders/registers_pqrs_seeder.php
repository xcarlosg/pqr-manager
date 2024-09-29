<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class registers_pqrs_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sql = "INSERT INTO `pqrs` (`pqr_date`, `pqr_type`, `pqr_methodnotify`, `pqr_cause`, `pqr_observation`, `pqr_evidence`, `user_id`, `created_at`, `updated_at`)
                VALUES 
                ('2024-09-01', 'Complaint', 'Yes', 'Late delivery', 'The delivery was delayed by two days.', NULL, 1, NOW(), NOW()),
                ('2024-09-02', 'Request', 'No', 'Information request', 'Need more information about the service.', NULL, 2, NOW(), NOW()),
                ('2024-09-03', 'Inquiry', 'Email', 'Inquiry about product availability.', 'Asked about a specific product.', NULL, 1, NOW(), NOW()),
                ('2024-09-04', 'Suggestion', 'SMS', 'Suggestion for better service.', 'Suggest to improve response time.', NULL, 3, NOW(), NOW());";

        DB::statement($sql);
    }
}