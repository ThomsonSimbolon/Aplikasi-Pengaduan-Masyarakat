<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ProfileController extends BaseController
{
    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new \App\Models\UsersModel();
    }
    public function index()
    {
        $id_user = session()->get('users_id');

        $data = [
            'title' => 'admin | Profile',
            'active' => 'profile',
            'nik' => session()->get('users_nik'),
            'admin' => $this->usersModel->find($id_user),
            // 'admin' => $this->usersModel->findAll(),
            'breadcrumb' => [
                'Home' => base_url('admin/home'),
                'Active Page' => 'Profile'
            ],
        ];

        return view('admin/v_profile', $data);
    }
}
