<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LeadController extends Controller
{

  public function index()
  {
    $leads = DB::table('leads')->get();
    return view('index')->with('leads', $leads);
  }
  public function store(Request $request)
  {
    if($request->has('zap')) {
      $lead = DB::table('leads')->where("name","=",$request->get('zap'));
      if(!$lead->get()) {
        DB::table('leads')->insert([
          'name' => $request->get('zap'),
          'leads' => 1
        ]);
        return response("Created new entry",200);
      }
      else {
        $lead->increment('leads');
        return response("Lead Added",200);
      }
    }
    return response("Nothing here, sorry !",403);
  }

}
