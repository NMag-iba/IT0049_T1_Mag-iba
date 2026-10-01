<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User</title>

    <style>
        h1 {
            text-align: center;
        }

        nav {
            text-align: center;
            margin: 20px;
        }

        nav a {
            margin: 0 10px;
        }

        form {
            width: 400px;
            margin: 20px auto;
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

        .error {
            display: block;
            color: red;
            margin-top: 5px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        button,
        .back-button {
            padding: 8px 15px;
            border: 1px solid #767676;
            border-radius: 2px;
            background-color: #efefef;
            color: black;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
        }

        button:hover,
        .back-button:hover {
            background-color: #dcdcdc;
        }
    </style>
</head>

<body>

    <h1>New User</h1>

    <nav>
        <a href="<?= site_url('/') ?>">Home</a>
        <a href="<?= site_url('about') ?>">About</a>
        <a href="<?= site_url('customers') ?>">Customer Accounts</a>
        <a href="<?= site_url('users') ?>">User Accounts</a>
    </nav>

    <form action="<?= site_url('users/new') ?>" method="post">

        <?= csrf_field() ?>

        <div class="form-group">
            <label for="username">Username:</label>

            <input
                type="text"
                id="username"
                name="username"
                value="<?= esc($input['username'] ?? '') ?>"
            >

            <?php if (! empty($errors['username'])): ?>
                <span class="error">
                    <?= esc($errors['username']) ?>
                </span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="full_name">Full Name:</label>

            <input
                type="text"
                id="full_name"
                name="full_name"
                value="<?= esc($input['full_name'] ?? '') ?>"
            >

            <?php if (! empty($errors['full_name'])): ?>
                <span class="error">
                    <?= esc($errors['full_name']) ?>
                </span>
            <?php endif; ?>
        </div>

        <div class="form-actions">
            <button type="submit">Save User</button>

            <a
                class="back-button"
                href="<?= site_url('users') ?>"
            >
                Return
            </a>
        </div>

    </form>

</body>
</html>