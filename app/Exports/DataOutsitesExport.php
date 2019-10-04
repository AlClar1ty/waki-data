<?php

namespace App\Exports;

use App\DataOutsite;
use App\Location;
use App\TypeCust;
use App\Branch;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataOutsitesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data_out = DB::table('data_outsites')
            ->join('branches', 'data_outsites.branch_id', '=', 'branches.id')
            ->leftjoin('locations', 'data_outsites.location_id', '=', 'locations.id')
            ->join('type_custs', 'data_outsites.type_cust_id', '=', 'type_custs.id')
            ->select('data_outsites.id','data_outsites.code','data_outsites.registration_date', 'data_outsites.name', 'data_outsites.phone', 'branches.name as branch', 'locations.name as location', 'type_custs.name as type_cust')
            ->where('data_outsites.active',1)->get();
        for ($i=0; $i < count($data_out); $i++) { 
            $data_out[$i]->phone = $this->Decr($data_out[$i]->phone);
        }
        return $data_out;
    }

    public static function Decr(string $x)
    {
        $pj = mb_strlen($x);
        //return $pj;
        $hasil = '';
        //return mb_chr('8223');
        //return ord('†'); //#226
        // return mb_ord('†'); //#8224
        // return mb_chr(134); //
        for($i=0; $i<$pj; $i++)
        {
            $ac = ord(substr($x, $i, 1))+4;
            //return $ac. "-";
            if($ac % 2 == 1)
            {
                $ac+=255;
            }
            $hs = $ac/2;
            //return $hs . "-";
            $hasil .= chr($hs);
        }
        return $hasil;
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
