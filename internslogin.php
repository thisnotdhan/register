<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Login</h2>
            </div>
            <div class="card-body">
                <form action="login_process.php" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
                <div class="text-center mt-3">
                    <a href="#" class="forgot-password">Forgot Password?</a>
                </div>
            </div>
            <div class="card-footer text-center">
                <p class="mb-0">Don't have an account?</p>
                <button onclick="location.href='internsregister.php'" class="btn btn-outline-primary">Register</button>
            </div>
        </div>
    </div>
</body>
</html>
