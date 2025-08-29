<?php

namespace App\Exports;

use App\Models\Admin\UserListModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserListExport implements FromCollection, WithHeadings
{
    protected $userLists;

    public function __construct($userLists)
    {
        $this->userLists = $userLists;
    }

    public function collection()
    {
        return $this->userLists->map(function ($user) {
            return [
                'ID'       => $user->id,
                'Name'     => $user->name,
                'Email'    => $user->email,
                'Password' => $user->password,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Password',
        ];
    }
}
