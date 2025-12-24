<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

echo "Checking database...\n";
if (Schema::hasTable('court_categories')) {
    if (!Schema::hasColumn('court_categories', 'image')) {
        echo "Adding image column...\n";
        Schema::table('court_categories', function (Blueprint $table) {
            $table->string('image')->nullable()->after('description');
        });
        echo "Column added successfully.\n";
    } else {
        echo "Column 'image' already exists.\n";
    }
} else {
    echo "Table 'court_categories' does not exist!\n";
}
