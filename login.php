<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - House Rental</title>
    <style>
        /* Global styles */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Main container */
        .login-container {
            display: flex;
            width: 95%; /* 95% of the screen width */
            max-width: 1400px; /* Maximum width for large screens */
            height: 85vh; /* 85% of the viewport height */
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        /* Left image section */
        .login-image {
            flex: 1.5; /* Slightly larger image section */
            background: url('assets/images/house.jpg') no-repeat center center;
            background-size: cover;
        }

        /* Right form section */
        .login-form {
            flex: 1; /* Smaller form section */
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-form h4 {
            font-size: 36px;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-control {
            width: 100%;
            padding: 16px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 18px;
        }

        .btn-primary {
            width: 100%;
            padding: 16px;
            background: #4a90e2;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 20px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: #357ab8;
        }

        .alert-danger {
            color: red;
            font-size: 0.9rem;
            margin-bottom: 10px;
            text-align: center;
        }

        /* Responsive design */
        @media (max-width: 1024px) {
            .login-container {
                height: auto;
                flex-direction: column;
            }

            .login-image {
                height: 300px;
                flex: none;
                width: 100%;
            }

            .login-form {
                padding: 40px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Left Image Section -->
        <div class="login-image"></div>

        <!-- Right Form Section -->
        <div class="login-form">
            <h4>House Rental</h4>
            <form id="login-form">
                <div class="form-group">
                    <label for="username" class="control-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username">
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#login-form').submit(function(e) {
        e.preventDefault();
        $('button[type="submit"]').attr('disabled', true).text('Logging in...');
        if ($(this).find('.alert-danger').length > 0)
            $(this).find('.alert-danger').remove();
        $.ajax({
            url: 'ajax.php?action=login',
            method: 'POST',
            data: $(this).serialize(),
            error: function(err) {
                console.log(err);
                $('button[type="submit"]').removeAttr('disabled').text('Login');
            },
            success: function(resp) {
                if (resp == 1) {
                    location.href = 'index.php?page=home';
                } else {
                    $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>');
                    $('button[type="submit"]').removeAttr('disabled').text('Login');
                }
            }
        });
    });
</script>
</html>
