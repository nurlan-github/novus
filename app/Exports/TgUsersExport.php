<?php

namespace App\Exports;


use App\Models\TGUsers;
use Maatwebsite\Excel\Concerns\FromCollection;

class TgUsersExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return TGUsers::all();
    }
}