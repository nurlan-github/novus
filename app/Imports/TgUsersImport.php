<?php

namespace App\Imports;


use App\Models\TGUsers;
use Maatwebsite\Excel\Concerns\ToModel;

class TgUsersImport implements ToModel
{
    public function model(array $row)
    {
        return new TGUsers([
            'user_id' => $row[1],
            'name' => $row[2],
            'phone_number' => $row[3],
            // 'additional_data' => [], // Qo'shimcha ma'lumotlar bo'sh array sifatida saqlanadi
        ]);
    }
}