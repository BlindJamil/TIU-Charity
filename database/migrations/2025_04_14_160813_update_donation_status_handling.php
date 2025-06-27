<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update the AdminDonationController to not use raised_amount
        $controllerPath = app_path('Http/Controllers/AdminDonationController.php');
        
        if (File::exists($controllerPath)) {
            $content = File::get($controllerPath);
            
            // Replace the code that updates the raised_amount
            $updatedContent = preg_replace(
                '/\/\/ If the status changed from pending to completed, update the cause raised amount\s+if \(\$oldStatus === \'pending\' && \$newStatus === \'completed\'\) {\s+\$cause = Cause::findOrFail\(\$donation->cause_id\);\s+\$cause->raised_amount \+= \$donation->amount;\s+\$cause->save\(\);\s+}/',
                '// Status changed from pending to completed
                if ($oldStatus === \'pending\' && $newStatus === \'completed\') {
                    // We need to handle this differently without using raised_amount
                    $cause = Cause::findOrFail($donation->cause_id);
                    // Handle any needed logic here without raised_amount
                    $cause->save();
                }',
                $content
            );
            
            File::put($controllerPath, $updatedContent);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to restore the code as it would be handled by git or other versioning
    }
};
