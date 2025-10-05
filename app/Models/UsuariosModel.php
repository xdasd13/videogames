<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table            = 'usuarios';
    protected $primaryKey       = 'idUsuario';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nombre', 'apellido', 'username', 'claveacceso', 'avatar', 'rol'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'nombre'      => 'required|min_length[3]|max_length[100]',
        'apellido'    => 'required|min_length[3]|max_length[100]',
        'username'    => 'required|min_length[3]|max_length[100]|is_unique[usuarios.username,idUsuario,{idUsuario}]',
        'claveacceso' => 'required|min_length[6]',
        'avatar'      => 'permit_empty',
        'rol'         => 'required|in_list[admin,usuario]'
    ];
    
    protected $validationMessages = [
        'username' => [
            'is_unique' => 'El nombre de usuario ya está en uso.'
        ]
    ];

    protected $skipValidation = false;

    /**
     * Verifica las credenciales del usuario
     */
    public function verificarCredenciales(string $username, string $password): ?array
    {
        $usuario = $this->where('username', $username)->first();
        
        if ($usuario && password_verify($password, $usuario['claveacceso'])) {
            unset($usuario['claveacceso']);
            return $usuario;
        }

        return null;
    }

    /**
     * Obtiene todos los usuarios excepto el actual
     */
    public function getOtherUsers(int $currentUserId): array
    {
        return $this->where('idUsuario !=', $currentUserId)
        ->findAll();
    }
}