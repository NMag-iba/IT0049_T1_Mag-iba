<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        $users = $userModel->findAll();

        return view('users', ['users' => $users]);
    }

    public function new()
    {
        $input = $this->request->getPost();

        if ($this->request->is('post')) {

            $rules = [
                'username' => [
                    'rules'  => 'required|is_unique[users.username]',
                    'errors' => [
                        'required'  => 'Username is required.',
                        'is_unique' => 'Username already exists.',
                    ],
                ],
                'full_name' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Full name is required.',
                    ],
                ],
            ];

            if (! $this->validateData($input, $rules)) {
                return view('user_form', [
                    'input'  => $input,
                    'errors' => $this->validator->getErrors(),
                ]);
            }

            $userModel = new UserModel();

            $userModel->insert([
                'username'   => $input['username'],
                'full_name'  => $input['full_name'],
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            return redirect()->to(site_url('users'));
        }

        return view('user_form', [
            'input'  => [],
            'errors' => [],
        ]);
    }
    public function edit($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (! $user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'User not found.'
            );
        }

        $input = $this->request->getPost();
        $file = $this->request->getFile('avatar');

        if ($this->request->is('post')) {
            $rules = [
                'username' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Username is required.',
                    ],
                ],
                'full_name' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Full name is required.',
                    ],
                ],
            ];

            // Validate the avatar only when a new file is selected.
            if ($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
                $rules['avatar'] = [
                    'rules'  => 'uploaded[avatar]|is_image[avatar]|mime_in[avatar,image/jpeg,image/png]|max_size[avatar,2048]',
                    'errors' => [
                        'uploaded'  => 'Please select an image.',
                        'is_image'  => 'The uploaded file must be an image.',
                        'mime_in'   => 'Only JPG and PNG files are allowed.',
                        'max_size'  => 'The image must not be larger than 2MB.',
                    ],
                ];
            }

            if (! $this->validate($rules)) {
                return view('user_edit', [
                    'input'  => $input,
                    'errors' => $this->validator->getErrors(),
                    'id'     => $id,
                ]);
            }

            $avatarFilename = $user['avatar'] ?? null;
            $oldAvatar = $user['avatar'] ?? null;

            if ($file && $file->isValid() && ! $file->hasMoved()) {
                $uploadDirectory = FCPATH . 'uploads/avatars/';

                if (! is_dir($uploadDirectory)) {
                    mkdir($uploadDirectory, 0755, true);
                }

                $avatarFilename = $file->getRandomName();

                service('image')
                    ->withFile($file->getTempName())
                    ->fit(300, 300, 'center')
                    ->save($uploadDirectory . $avatarFilename);
            }

            $userModel->update($id, [
                'username'  => $input['username'],
                'full_name' => $input['full_name'],
                'avatar'    => $avatarFilename,
            ]);

            // Delete the old avatar after a new one has been saved.
            if (
                $oldAvatar &&
                $oldAvatar !== $avatarFilename &&
                is_file(FCPATH . 'uploads/avatars/' . $oldAvatar)
            ) {
                unlink(FCPATH . 'uploads/avatars/' . $oldAvatar);
            }

            return redirect()->to(site_url('users'));
        }

        return view('user_edit', [
            'input'  => $user,
            'errors' => [],
            'id'     => $id,
        ]);
    }
}