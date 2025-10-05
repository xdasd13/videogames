<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;

class HomeController extends BaseController
{
    protected $usuariosModel;
    protected $session;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->usuariosModel = new UsuariosModel();
        $this->session = session();
    }

    public function index()
    {
        if (!$this->session->has('usuario')) {
            return redirect()->to('/login');
        }

        return view('home');
    }

    public function profile()
    {
        if (!$this->session->has('usuario')) {
            return redirect()->to('/login');
        }

        $usuario = $this->usuariosModel->find($this->session->get('usuario')['idUsuario']);
        return view('profile', ['usuario' => $usuario]);
    }

    public function updateAvatar()
    {
        if (!$this->session->has('usuario')) {
            return redirect()->to('/login');
        }

        $validationRules = [
            'avatar' => [
                'rules' => 'uploaded[avatar]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]|max_size[avatar,2048]',
                'label' => 'Avatar'
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $avatar = $this->request->getFile('avatar');
        $newName = $avatar->getRandomName();
        
        // Asegurar que el directorio existe
        $uploadPath = ROOTPATH . 'public/images/avatar';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }
        
        if ($avatar->move($uploadPath, $newName)) {
            $userId = $this->session->get('usuario')['idUsuario'];
            
            // Obtener el avatar anterior
            $usuario = $this->usuariosModel->find($userId);
            $oldAvatar = $usuario['avatar'];
            
            // Actualizar con la nueva ruta
            $newAvatarPath = '/images/avatar/' . $newName; // Cambiado para usar ruta relativa con slash inicial
            $this->usuariosModel->update($userId, [
                'avatar' => $newAvatarPath
            ]);

            // Eliminar avatar anterior si no es el default
            if ($oldAvatar !== 'public/images/avatar/usuario.png' && file_exists(ROOTPATH . 'public' . $oldAvatar)) {
                unlink(ROOTPATH . 'public' . $oldAvatar);
            }

            // Actualizar la sesión con los datos nuevos
            $usuario = $this->usuariosModel->find($userId);
            $this->session->set('usuario', $usuario);

            return redirect()->back()->with('message', 'Avatar actualizado correctamente');
        }

        return redirect()->back()->with('error', 'Error al subir el avatar');
    }

    public function userList()
    {
        if (!$this->session->has('usuario')) {
            return redirect()->to('/login');
        }

        $usuario = $this->session->get('usuario');
        if ($usuario['rol'] !== 'admin') {
            return redirect()->to('/home')->with('error', 'Acceso no autorizado');
        }

        $usuarios = $this->usuariosModel->getOtherUsers($usuario['idUsuario']);
        return view('users/list', ['usuarios' => $usuarios]);
    }
}