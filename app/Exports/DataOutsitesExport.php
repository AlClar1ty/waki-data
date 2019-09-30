<?php

namespace App\Exports;

use App\DataOutsite;
use App\Location;
use App\TypeCust;
use App\Branch;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataOutsitesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DataOutsite::join('branches', 'data_outsites.branch_id', '=', 'branches.id')
	        ->leftjoin('locations', 'data_outsites.location_id', '=', 'locations.id')
	        ->join('type_custs', 'data_outsites.type_cust_id', '=', 'type_custs.id')
	        ->select('data_outsites.id','data_outsites.code','data_outsites.registration_date', 'data_outsites.name', 'data_outsites.phone', 'branches.name as branch', 'locations.name as location', 'type_custs.name as type_cust')
	        ->where('data_outsites.active',1)->get();
    }

    public function headings():array
    {
    	return[
    		'ID',
    		'Code',
    		'Registration Date',
    		'Name',
    		'Phone',
    		'Branch',
    		'Location',
    		'Type Cust'
    	];
    }
}
