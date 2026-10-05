<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        h1 {
            text-align: center;
        }

        form {
            width: 400px;
            margin: 10px auto 30px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            padding: 8px 15px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h1>Login</h1>

    <form action="<?= site_url('login') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username">
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
        </div>
        
        <?php if (session()->getFlashdata('error')): ?>
            <p style="color: red; margin: 0 0 10px;">
                <?= esc(session()->getFlashdata('error')) ?>
            </p>
        <?php endif; ?>

        <button type="submit">Login</button>


    </form>

</body>
</html>