<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lga_polling_units_result_model;
use Illuminate\Support\Facades\DB;

class All_polling_result extends Controller
{
    public function getAllpollingResult(){
        $list = $this->get_lga_list();

        
        return view('all_polling_unit_result',[
            'lgaList' => $list
        ]);
    }

    public function get_lga_list(){
        $lgas = DB::table('lga')
                    ->SELECT('*')
                    ->where('lga_name','!=', '')
                    ->get();

        return $lgas;
    }

    public function get_result($lga){
        // dd($lga);
        $res = DB::table('announced_pu_results')
                    ->join('polling_unit', 'announced_pu_results.polling_unit_uniqueid', '=', 'polling_unit.polling_unit_id')
                    ->select('polling_unit.party_abbreviation', 'announced_pu_results.party_abbreviation', DB::raw('SUM(IFNULL(announced_pu_results.party_score, 0)) as score'))
                    ->where([
                        ['announced_pu_results.polling_unit_uniqueid', '=', 'polling_unit.polling_unit_id'],
                        ['polling_unit.lga_id','=', $lga]
                    ])
                    ->groupBy('polling_unit.lga_id','announced_pu_results.polling_unit_uniqueid', 'announced_pu_results.party_abbreviation')
                    ->orderByRaw('announced_pu_results.party_abbreviation ASC')
                    ->get();

                    dd($res);

    }
}
