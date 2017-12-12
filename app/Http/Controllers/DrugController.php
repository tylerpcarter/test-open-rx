<?php

namespace App\Http\Controllers;

use App\Drug;
use App\Type;
use App\Schedule;
use App\Brand;
use App\Treatment;
use App\Condition;
use Illuminate\Http\Request;

class DrugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drugs = Drug::all();

        foreach ($drugs as $drug) {
          $drug["type"] = Type::find($drug->type_id)->name;
          $drug["schedule"] = Schedule::find($drug->schedule_id)->name;
          $drug["brands"] = Brand::where('drug_id', $drug->id)->get();
          $treatments = Treatment::where('did', $drug->id)->get();
          $id = array();
          foreach ($treatments as $treatment) {
            $id[] = $treatment->cid;
          }
          $drug["conditions"] = Condition::find($id);
        }

        return $drugs;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function show(Drug $drug)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function edit(Drug $drug)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Drug $drug)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function destroy(Drug $drug)
    {
        //
    }
}
