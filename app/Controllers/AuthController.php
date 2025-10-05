<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;

class AuthController extends BaseController
{
    protected $usuariosModel;
    protected $session;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->usuariosModel = new UsuariosModel();
        $this->session = session();
    }

    public function login()
    {
        // Si ya está logueado, redirigir a home
        if ($this->session->has('usuario')) {
            return redirect()->to('/home');
        }
        
        return view('auth/login');
    }

    public function auth()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $usuario = $this->usuariosModel->verificarCredenciales($username, $password);

        if ($usuario) {
            $this->session->set('usuario', $usuario);
            return redirect()->to('/home')->with('message', 'Bienvenido ' . $usuario['nombre']);
        }

        // Verificar si el usuario existe para mostrar el mensaje adecuado
        $exists = $this->usuariosModel->where('username', $username)->first();
        
        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Su clave es incorrecta.');
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'No existe el usuario: ' . $username);
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login')->with('message', 'Sesión cerrada correctamente');
    }

    protected function isLoggedIn()
    {
        return $this->session->has('usuario');
    }
}