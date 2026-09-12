<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index()
    {
        $users = [
            [
                'username' => 'marithesantos',
                'full_name' => 'Marithe Santos',
                'role' => 'Cashier'
            ],
            [
                'username' => 'limbuan_d',
                'full_name' => 'Dorothy Limbuan',
                'role' => 'Manager'
            ],
            [
                'username' => 'aliyah_salva',
                'full_name' => 'Aliyah Salvador',
                'role' => 'Cashier'
            ],
            [
                'username' => 'kdela_paz',
                'full_name' => 'Kirsten Dela Paz',
                'role' => 'Admin'
            ],
            [
                'username' => 'yanversoza',
                'full_name' => 'Maryan Versoza',
                'role' => 'Cashier'
            ]
        ];

        return view('users', ['users' => $users]);
    }
}