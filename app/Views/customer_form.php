<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Customer</title>

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

    <h1>New Customer</h1>

    <nav>
        <a href="<?= site_url('/') ?>">Home</a>
        <a href="<?= site_url('about') ?>">About</a>
        <a href="<?= site_url('customers') ?>">Customer Accounts</a>
        <a href="<?= site_url('users') ?>">User Accounts</a>
    </nav>

    <form action="<?= site_url('customers/new') ?>" method="post">

        <?= csrf_field() ?>

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

        <div class="form-group">
            <label for="email">Email:</label>

            <input
                type="email"
                id="email"
                name="email"
                value="<?= esc($input['email'] ?? '') ?>"
            >

            <?php if (! empty($errors['email'])): ?>
                <span class="error">
                    <?= esc($errors['email']) ?>
                </span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="phone">Phone:</label>

            <input
                type="tel"
                id="phone"
                name="phone"
                value="<?= esc($input['phone'] ?? '') ?>"
            >

            <?php if (! empty($errors['phone'])): ?>
                <span class="error">
                    <?= esc($errors['phone']) ?>
                </span>
            <?php endif; ?>
        </div>

        <div class="form-actions">
            <button type="submit">Save Customer</button>

            <a
                class="back-button"
                href="<?= site_url('customers') ?>"
            >
                Return
            </a>
        </div>

    </form>

</body>
</html>