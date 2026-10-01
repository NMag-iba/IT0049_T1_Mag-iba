<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Accounts</title>

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

        .edit-link {
            font-weight: bold;
            text-decoration: none;
            padding-bottom: 2px;
        }
    </style>
</head>

<body>

    <h1>Customer Accounts</h1>

    <nav>
        <a href="<?= site_url('/') ?>">Home</a>
        <a href="<?= site_url('about') ?>">About</a>
        <a href="<?= site_url('customers') ?>">Customer Accounts</a>
        <a href="<?= site_url('users') ?>">User Accounts</a>
    </nav>

    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Edit</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= esc($customer['full_name']) ?></td>
                    <td><?= esc($customer['email']) ?></td>
                    <td><?= esc($customer['phone']) ?></td>
                    <td>
                        <a
                            class="edit-link"
                            href="<?= site_url('customers/edit/' . $customer['id']) ?>"
                            aria-label="Edit <?= esc($customer['full_name']) ?>"
                        >
                            Edit
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="add-button">
        <a href="<?= site_url('customers/new') ?>">
            Add Customer
        </a>
    </div>

</body>
</html>