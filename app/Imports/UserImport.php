<?php

namespace App\Imports;
use Spatie\Permission\Traits\HasRoles;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;


class UserImport implements ToModel, WithHeadingRow 
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function model(array $row)
    {
        return User::create([
            'first_name' => $row['first_name'],
            'middle_name' => $row['middle_name'],
            'last_name' => $row['last_name'],
            'student_id' => $row['student_id'],
            'course' => $row['course'],
            'email' => $row['email'],
            'password' => Hash::make($row['password']),
        ])->assignRole('student');
    }
}
