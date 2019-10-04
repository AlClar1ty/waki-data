<?php

namespace App\Exports;

use App\DataUndangan;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataUndanganExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {   
        $data_und = DB::table('data_undangans')
            ->select('id','code','registration_date','name','address','phone','birth_date')
            ->where('active',1)->get();
        for ($i=0; $i < count($data_und) ; $i++) { 
            $data_und[$i]->phone = $this->Decr($data_und[$i]->phone);
        }
        return $data_und;
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
    		'Birth Date'
    	];
    }
}
