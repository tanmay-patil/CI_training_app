<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
     <link rel="stylesheet" href="<?php echo asset_url().'css/login.css'; ?>">
</head>

<body>
    <div id="login_form_container">

        <?php
            if(isset($failed_attempt)){
                if($failed_attempt){
                    echo "<h2 class='ci-error-color'>Login Failed</h1>";
                }
            }
        ?>

        <form action='<?php echo controller_url()."Login_controller/login";?>' method='post'>
            <div class="form-group">
                <label for="username">User Name / Email</label>
                <input name="username" type="username" class="form-control" id="username">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input name="password" type="password" class="form-control" id="password">
            </div>
            <div class="form-check">
                <label class="form-check-label">
        <input class="form-check-input" type="checkbox"> Remember me
        </label>
            </div>
            <button type="submit" name='submit' class="ci-btn ci-btn-blue">Submit</button>
        </form>
    </div>
</body>

</html>