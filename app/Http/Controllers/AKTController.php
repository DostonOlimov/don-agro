<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AKTController extends Controller
{
    function list() {
        // $cities = DB::table('tbl_countries')->
        // select('tbl_cities.name as district', 'tbl_states.name as region', 'tbl_cities.id')->
        // where('tbl_countries.id', '=', 234)->
        // join('tbl_states', 'tbl_countries.id', '=', 'tbl_states.country_id')->
        // join('tbl_cities', 'tbl_states.id', '=', 'tbl_cities.state_id')->
        // get()->toArray();
        return view('AKT.list');
    }
    function add() {

    }
    function store(Request $request) {

    }
    function edit($id) {

    }
    function update(Request $request, $id) {

    }
    function delete($id) {

    }
}
