<?php

namespace App\Controllers;

class Customers extends BaseController
{
    public function index()
    {
        $customers = [
            [
                'full_name' => 'Nathan Cruz',
                'email' => 'nathancruz@gmail.com',
                'phone' => '09171234567'
            ],
            [
                'full_name' => 'Caleb Dela Cruz',
                'email' => 'calebdcruz@gmail.com',
                'phone' => '09181234567'
            ],
            [
                'full_name' => 'Agnes Robles',
                'email' => 'arobles@gmail.com',
                'phone' => '09191234567'
            ],
            [
                'full_name' => 'Maria Castillo',
                'email' => 'mcastillo@gmail.com',
                'phone' => '09201234567'
            ],
            [
                'full_name' => 'Alex Angeles',
                'email' => 'alexangeles@gmail.com',
                'phone' => '09211234567'
            ]
        ];

        return view('customers', ['customers' => $customers]);
    }
}