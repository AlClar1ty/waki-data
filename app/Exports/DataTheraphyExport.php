<?php

namespace App\Exports;

use App\DataTherapy;
use App\DataOutsite;
use App\Location;
use App\TypeCust;
use App\Branch;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataTheraphyExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DataTherapy::join('branches', 'data_therapies.branch_id', '=', 'branches.id')
        	->join('type_custs', 'data_therapies.type_cust_id', '=', 'type_custs.id')
	        ->select('data_therapies.id','data_therapies.code','data_therapies.registration_date','data_therapies.name','data_therapies.address','data_therapies.phone','data_therapies.province','data_therapies.district','branches.name as branch','type_custs.name as type_cust')
	        ->where('data_therapies.active',1)
	        ->get();
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
    		'Province',
    		'District',
    		'Branch',
    		'Type Cust'
    	];
    }
}
