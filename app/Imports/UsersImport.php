<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $user = new User();
        $user->name = $row[1];
        $user->email = $row[2];
        $user->email_verified_at = $row[3];
        $user->password = $row[4];
        $user->remember_token = $row[5];
        $user->created_at = $row[6];
        $user->updated_at = $row[7];
        $user->phone = $row[8];
        $user->save();
    }
}
