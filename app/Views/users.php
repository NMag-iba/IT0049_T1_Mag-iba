<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Accounts</title>

    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #d9f2d9;
        }

        th:first-child,
        td:first-child,
        th:last-child,
        td:last-child {
            text-align: center;
        }

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

        .add-button {
            text-align: center;
            margin: 20px;
        }

        .add-button a {
            display: inline-block;
            padding: 10px 15px;
            background-color: #d9f2d9;
            border: 1px solid #ccc;
            text-decoration: none;
            color: black;
        }

        .add-button a:hover {
            background-color: #c5e6c5;
        }

        .avatar {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border: 1px solid #ccc;
        }

        .edit-link {
            font-weight: bold;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <h1>User Accounts</h1>

    <nav>
        <a href="<?= site_url('/') ?>">Home</a>
        <a href="<?= site_url('about') ?>">About</a>
        <a href="<?= site_url('customers') ?>">Customer Accounts</a>
        <a href="<?= site_url('users') ?>">User Accounts</a>
        <a href="<?= site_url('logout') ?>">Logout</a>
    </nav>

    <table>
        <thead>
            <tr>
                <th>Avatar</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Created At</th>
                <th>Edit</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($users as $user): ?>
                <?php
                    $avatarFile = $user['avatar'] ?? null;

                    $avatarExists = $avatarFile &&
                        is_file(FCPATH . 'uploads/avatars/' . $avatarFile);

                    $avatarUrl = $avatarExists
                        ? base_url('uploads/avatars/' . rawurlencode($avatarFile))
                        : base_url('uploads/avatar-placeholder.svg');
                ?>

                <tr>
                    <td>
                        <img
                            class="avatar"
                            src="<?= esc($avatarUrl) ?>"
                            alt="<?= esc($user['username']) ?> avatar"
                        >
                    </td>

                    <td><?= esc($user['username']) ?></td>
                    <td><?= esc($user['full_name']) ?></td>
                    <td><?= esc($user['created_at']) ?></td>

                    <td>
                        <a
                            class="edit-link"
                            href="<?= site_url('users/edit/' . $user['id']) ?>"
                        >
                            Edit
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="add-button">
        <a href="<?= site_url('users/new') ?>">
            Add User
        </a>
    </div>

</body>
</html>