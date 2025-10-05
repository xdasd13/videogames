<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SUsuarios extends Seeder
{
    public function run()
    {
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
            [
                'nombre'      => 'Admin',
                'apellido'    => 'System',
                'username'    => 'admin',
                'claveacceso' => password_hash('admin123', PASSWORD_DEFAULT),
                'avatar'      => $defaultAvatar,
                'rol'         => 'admin',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            ],
            [
                'nombre'      => 'Usuario',
                'apellido'    => 'Demo',
                'username'    => 'usuario1',
                'claveacceso' => password_hash('user123', PASSWORD_DEFAULT),
                'avatar'      => $defaultAvatar,
                'rol'         => 'usuario',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            ],
            [
                'nombre'      => 'Usuario',
                'apellido'    => 'Prueba',
                'username'    => 'usuario2',
                'claveacceso' => password_hash('user456', PASSWORD_DEFAULT),
                'avatar'      => $defaultAvatar,
                'rol'         => 'usuario',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            ]
        ];

        foreach ($data as $row) {
            $this->db->table('usuarios')->insert($row);
        }
    }
}