<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Events\AfterImport;

class UsersImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{

    public function model(array $row)
    {
        return new User([
            'name' => $row['nombre'],
            'email' => $row['correo'],
            'telefono' => $row['telefono'],
            'password' => $row['pasword'],
            'perfil_id' => $row['perfil'],
        ]);
    }

    public function batchSize(): int
    {
        return 4000;
    }

    public function chunkSize(): int
    {
        return 4000;
    }

}
