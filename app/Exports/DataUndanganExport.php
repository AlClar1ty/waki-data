<?php

namespace App\Exports;

use App\DataUndangan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataUndanganExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DataUndangan::select('id','code','registration_date','name','address','phone','birth_date')
        	->where('active',1)->get();
    }

    public function headings():array
    {
    	return[
    		'ID',
    		'Code',
    		'Registration Date',
    		'Name',
    		'Address',
    		'Phone',
    		'Birth Date'
    	];
    }
}
