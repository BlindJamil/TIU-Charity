<?php

// Bootstrap the Laravel application
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

// Function to check the admin authentication
function checkAdminAuth() {
    echo "<h2>Admin Authentication Test</h2>";
    
    // Check admin guard
    if (Auth::guard('admin')->check()) {
        $admin = Auth::guard('admin')->user();
        echo "<p>Admin is logged in: {$admin->name} ({$admin->email})</p>";
    } else {
        echo "<p>No admin currently logged in</p>";
    }
    
    // Display admin table info
    echo "<h3>Admin Users Table</h3>";
    $adminUsers = DB::table('admin_users')->get();
    
    if (count($adminUsers) > 0) {
        echo "<ul>";
        foreach ($adminUsers as $user) {
            echo "<li>ID: {$user->id}, Name: {$user->name}, Email: {$user->email}</li>";
            
            // Check password for test user
            if ($user->email === 'admin@test.com') {
                $passwordCheck = Hash::check('admin123', $user->password);
                echo " - Password check: " . ($passwordCheck ? "VALID" : "INVALID");
            }
        }
        echo "</ul>";
    } else {
        echo "<p>No admin users found in database</p>";
    }
    
    // Display roles
    echo "<h3>Admin Roles</h3>";
    $roles = DB::table('admin_roles')->get();
    
    if (count($roles) > 0) {
        echo "<ul>";
        foreach ($roles as $role) {
            echo "<li>ID: {$role->id}, Name: {$role->name}</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No admin roles found in database</p>";
    }
    
    // Display role assignments
    echo "<h3>Role Assignments</h3>";
    $assignments = DB::table('admin_role_user')
        ->join('admin_users', 'admin_users.id', '=', 'admin_role_user.admin_user_id')
        ->join('admin_roles', 'admin_roles.id', '=', 'admin_role_user.admin_role_id')
        ->select('admin_users.name as user_name', 'admin_users.email', 'admin_roles.name as role_name')
        ->get();
        
    if (count($assignments) > 0) {
        echo "<ul>";
        foreach ($assignments as $assignment) {
            echo "<li>User: {$assignment->user_name} ({$assignment->email}), Role: {$assignment->role_name}</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No role assignments found in database</p>";
    }
}

// Handle admin login test
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    echo "<h3>Login Attempt</h3>";
    echo "<p>Trying to login with email: {$email}</p>";
    
    // Try login with credentials
    if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])) {
        echo "<p style='color:green'>Login successful!</p>";
    } else {
        echo "<p style='color:red'>Login failed.</p>";
        
        // Direct DB check
        $admin = DB::table('admin_users')->where('email', $email)->first();
        if ($admin) {
            echo "<p>Admin user found in database.</p>";
            if (Hash::check($password, $admin->password)) {
                echo "<p>Password is correct.</p>";
                
                // Try manual login
                if (Auth::guard('admin')->loginUsingId($admin->id)) {
                    echo "<p style='color:green'>Manual login successful!</p>";
                } else {
                    echo "<p style='color:red'>Manual login failed.</p>";
                }
            } else {
                echo "<p>Password is incorrect.</p>";
            }
        } else {
            echo "<p>Admin user not found in database.</p>";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Authentication Test</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { margin-bottom: 20px; padding: 15px; border: 1px solid #ccc; }
        input, button { margin: 5px 0; padding: 8px; }
        h2, h3 { margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Admin Authentication Test</h1>
    
    <form method="post">
        <h3>Test Admin Login</h3>
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="admin@test.com">
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="password" value="admin123">
        </div>
        <button type="submit">Login</button>
    </form>
    
    <?php checkAdminAuth(); ?>
</body>
</html> 