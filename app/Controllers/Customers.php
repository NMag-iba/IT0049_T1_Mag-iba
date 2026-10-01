<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customers extends BaseController
{
    public function index()
    {
        $customerModel = new CustomerModel();

        return view('customers', [
            'customers' => $customerModel->findAll(),
        ]);
    }

    public function new()
    {
        $input = $this->request->getPost();

        if ($this->request->is('post')) {

            $rules = [
                'full_name' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Full name is required.',
                    ],
                ],
                'email' => [
                    'rules'  => 'required|valid_email',
                    'errors' => [
                        'required'    => 'Email is required.',
                        'valid_email' => 'Please enter a valid email address.',
                    ],
                ],
                'phone' => [
                    'rules' => 'permit_empty',
                ],
            ];

            if (! $this->validateData($input, $rules)) {
                return view('customer_form', [
                    'input'  => $input,
                    'errors' => $this->validator->getErrors(),
                ]);
            }

            $customerModel = new CustomerModel();

            $customerModel->insert([
                'full_name'  => $input['full_name'],
                'email'      => $input['email'],
                'phone'      => $input['phone'] ?? null,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            return redirect()->to(site_url('customers'));
        }

        return view('customer_form', [
            'input'  => [],
            'errors' => [],
        ]);
    }
    public function edit($id)
    {
        $customerModel = new CustomerModel();
        $customer = $customerModel->find($id);

        if (! $customer) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'Customer not found.'
            );
        }

        $input = $this->request->getPost();

        if ($this->request->is('post')) {
            $rules = [
                'full_name' => 'required',
                'email'     => 'required|valid_email',
                'phone'     => 'required',
            ];

            if (! $this->validateData($input, $rules)) {
                return view('customer_edit', [
                    'input'  => $input,
                    'errors' => $this->validator->getErrors(),
                    'id'     => $id,
                ]);
            }

            $customerModel->update($id, [
                'full_name' => $input['full_name'],
                'email'     => $input['email'],
                'phone'     => $input['phone'],
            ]);

            return redirect()->to(site_url('customers'));
        }

        return view('customer_edit', [
            'input'  => $customer,
            'errors' => [],
            'id'     => $id,
        ]);
    }
}