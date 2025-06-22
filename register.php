<?php include('includes/header.php'); ?>
    <form action="registerCode.php" method="POST">
        <div class="container mt-5 p-5 border border-2 rounded bg-dark w-50 mx-auto">
            <h2 class="text-center text-light">Register</h2>
            <div class="form-group">
                <label for="username">Username : </label>
                <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required/>
            </div>
            <div class="form-group my-2">
                <label for="email">Email : </label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required/>
            </div>
            <div class="form-group my-2">
                <label for="password">Password : </label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required/>
            </div>
            <div class="form-group my-2">
                <label for="confirm_password">Confirm Password : </label>
                <input type="password" class="form-control" id="confirm_password" placeholder="Confirm password" name="confirm_password" required/>
            </div>
            <div class="form-group my-2">
                <button type="submit" class="btn btn-primary">Register</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </div>
            <div class="form-group">
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </div>
    </form>
<?php include('includes/footer.php'); ?>