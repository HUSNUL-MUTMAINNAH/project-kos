<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sign In - Kos Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow-sm p-4" style="max-width:380px;width:100%;">
        <h3 class="text-center mb-2">Sign In</h3>
        <p class="text-center text-muted mb-4">Enter your credentials to continue</p>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger py-2"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="post" action="/?r=login_post">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required placeholder="Email">
            </div>
            <div class="mb-3">
                <label class="form-label d-flex justify-content-between">
                    <span>Password</span>
                </label>
                <input type="password" name="password" class="form-control" required placeholder="Password">
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <a href="#" class="small text-decoration-none">Forgot password?</a>
            </div>
            <button class="btn btn-primary w-100 mb-3">Sign In</button>
            <p class="text-center small text-muted mb-0">
                Don't have an account? <a href="/?r=register" class="text-primary">Create one</a>
            </p>
        </form>
    </div>
</body>
</html>
