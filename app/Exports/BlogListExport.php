<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BlogListExport implements FromCollection, WithHeadings
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
                'Title'     => $user->title,
                'Description'    => $user->description,
                'File' => $user->file,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Description',
            'File',
        ];
    }
}
