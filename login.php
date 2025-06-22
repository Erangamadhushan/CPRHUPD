<?php include('includes/header.php'); ?>
    <form action="logingcode.php" method="post">
        <div class="container mt-5 p-5 border border-2 rounded bg-dark w-50 mx-auto">
            <h2 class="text-center text-light">Login</h2>
            <div class="form-group my-2">
                <label for="username">Username : </label>
                <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required/>
            </div>
            <div class="form-group my-2">
                <label for="password">Password : </label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required/>
            </div>
            <div class="form-group my-2">
                <button type="submit" class="btn btn-primary">Login</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </div>
            <div class="form-group">
                <p>Don't have an account? <a href="register.php">Register here</a></p>
            </div>
        </div>
    </form>
<?php include('includes/footer.php'); ?>

