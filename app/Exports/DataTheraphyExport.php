<?php

namespace App\Exports;

use App\DataTherapy;
use App\DataOutsite;
use App\Location;
use App\TypeCust;
use App\Branch;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataTheraphyExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {   
        $data_ther = DB::table('data_therapies')
            ->join('branches', 'data_therapies.branch_id', '=', 'branches.id')
            ->join('type_custs', 'data_therapies.type_cust_id', '=', 'type_custs.id')
            ->select('data_therapies.id','data_therapies.code','data_therapies.registration_date','data_therapies.name','data_therapies.address','data_therapies.phone','data_therapies.province','data_therapies.district','branches.name as branch','type_custs.name as type_cust')
            ->where('data_therapies.active',1)
            ->get();
        for ($i=0; $i < count($data_ther); $i++) { 
            $data_ther[$i]->phone = $this->Decr($data_ther[$i]->phone);
        }
        return $data_ther;
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
    		'Address',
    		'Phone',
    		'Province',
    		'District',
    		'Branch',
    		'Type Cust'
    	];
    }
}
