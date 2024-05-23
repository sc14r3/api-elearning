<?php

namespace App;

use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        return new User([
            'name'     => $row['nombre'],
            'last_name' => $row['apellidos'],
            'email' => $row['correo'],
            'phone_number' => $row['telefono'],
            'date_of_birth' => $row['nacimiento'],
            'curp' => $row['curp'],
            'password' => Hash::make($row['password']),
            'rol_id' => $row['rol'],
            'status' => 'ACTIVE'
        ]);
    }
}