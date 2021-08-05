<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\individualPu_model;
use Illuminate\Support\Facades\DB;


class individual_pu extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $poling = new polling_unit();
        $pol = $this->get_polling_list();

        return view('pollingunit', [
            'pollingList' => $pol
        ]);
    }

    public function fetch_by_pu($id){
        $pol_result = DB::table('announced_pu_results')
                    ->SELECT('party_abbreviation', DB::raw('SUM(IFNULL(party_score, 0)) as score'))
                    ->where('polling_unit_uniqueid','=',$id)
                    ->groupBy('polling_unit_uniqueid', 'party_abbreviation')
                    ->orderByRaw('party_abbreviation ASC')
                    ->get();

        $polllist = $this->get_polling_list();

        if(count($pol_result) == 0) return response()->json([
            'status' =>false, 'pollingList'=> $polllist, 'id' => $id
        ]);

       return response()->json([
            'status' => true, 
            'scorelist' => $pol_result,
            'pollingList'=> $polllist,
            'id' => $id
        ]);

        
    }

    public function get_polling_list(){
        $pol = DB::table('polling_unit')
                    ->SELECT('*')
                    ->where('polling_unit_id','!=', '0')
                    ->distinct('polling_unit_id')
                    ->get();

        return $pol;
    }
   
}
