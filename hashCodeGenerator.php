<?php
session_start();
require_once "functionSet.php";


if (!isset($_SESSION['role']) || $_SESSION['role'] !== "admin") {
    die("Access denied.");
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $target_id = trim($_POST["target_id"]);
    $new_pass = trim($_POST["new_password"]);

    if (empty($target_id) || empty($new_pass)) {
        $message = "ID and new password cannot be empty.";
    } else {

        $table = ($target_id < 600) ? "host" : "guest";
        $key = ($target_id < 600) ? "host_id" : "guest_id";

        $check = $pdo->prepare("SELECT $key FROM $table WHERE $key = :id");
        $check->execute([":id" => $target_id]);

        if ($check->rowCount() === 0) {
            $message = "ID $target_id does NOT exist.";
        } else {
            $hashed = password_hash($new_pass, PASSWORD_DEFAULT);
            $update = $pdo->prepare("UPDATE $table SET password = :pw WHERE $key = :id");
            $update->execute([":pw" => $hashed, ":id" => $target_id]);

            $message = "Password updated successfully for ID $target_id.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Password Changer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">

<h2 class="mb-4">Admin: Change User Password</h2>

<?php if (!empty($message)): ?>
    <div class="alert alert-info"><?= $message ?></div>
<?php endif; ?>

<form method="POST" class="shadow p-4 rounded bg-light" style="max-width: 500px;">
    <div class="mb-3">
        <label class="form-label">Target User ID (Host or Guest)</label>
        <input type="number" name="target_id" class="form-control" required>
        <small class="text-muted">Host IDs &lt; 600, Guest IDs ≥ 600</small>
    </div>

    <div class="mb-3">
        <label class="form-label">New Password</label>
        <input type="password" name="new_password" class="form-control" required>
    </div>

    <button class="btn btn-primary">Change Password</button>
</form>

<span class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
    <a href="Admin_eventM.php">Back</a>
</span>

</body>
</html>