<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;

class RegisterController extends BaseController
{
    protected $usuariosModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->usuariosModel = new UsuariosModel();
    }

    public function index()
    {
        return view('auth/register');
    }

    public function create()
    {
        $rules = [
            'nombre'      => 'required|min_length[3]|max_length[100]',
            'apellido'    => 'required|min_length[3]|max_length[100]',
            'username'    => 'required|min_length[3]|max_length[100]|is_unique[usuarios.username]',
            'claveacceso' => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Asegurarse de que existe el directorio de avatares
        $avatarDir = ROOTPATH . 'public/images/avatar';
        if (!is_dir($avatarDir)) {
            mkdir($avatarDir, 0777, true);
        }

        // Asegurarse de que existe la imagen por defecto
        $defaultAvatar = 'images/avatar/usuario.png';
        $defaultAvatarPath = ROOTPATH . 'public/' . $defaultAvatar;
        
        if (!file_exists($defaultAvatarPath)) {
            // Si no existe, crear una imagen por defecto
            copy(ROOTPATH . 'public/favicon.ico', $defaultAvatarPath);
        }

        $data = [
            'nombre'      => $this->request->getPost('nombre'),
            'apellido'    => $this->request->getPost('apellido'),
            'username'    => $this->request->getPost('username'),
            'claveacceso' => password_hash($this->request->getPost('claveacceso'), PASSWORD_DEFAULT),
            'avatar'      => $defaultAvatar,
            'rol'         => 'usuario'
        ];

        $this->usuariosModel->insert($data);

        return redirect()->to('/login')
        ->with('message', 'Registro exitoso. Por favor, inicie sesión.');
    }
}