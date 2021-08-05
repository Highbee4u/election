<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\New_polling_units_Model;
use Illuminate\Support\Facades\DB;


class New_polling_units extends Controller
{
    public function index(){
        return view('add_new_polling_Result', [
            'statelists' => $this->get_State_list(),
        ]);
    }

    public function get_State_list(){
        $states_list = DB::table('states')
                    ->Select('*')
                    ->get();

        return $states_list;
    }

    public function get_lga_by_state($state_id){
        $lga_by_state = DB::table('lga')
                    ->Select('*')
                    ->get();

        return $lga_by_state;
    }   
}
