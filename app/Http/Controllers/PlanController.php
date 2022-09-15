<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use Session;
//class AsyncOperation extends \Thread {
//
//    public function __construct() {
//    }
//
//    public function run() {
//        sleep(5);
//        return view('plans.form');
//    }
//}


class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        // Create a array
//        $stack = array();
//
////Initiate Multiple Thread
////        foreach ( range("A", "D") as $i ) {
//            $stack[] = new AsyncOperation();
////        }
//
//// Start The Threads
//        foreach ( $stack as $t ) {
//            $t->start();
//        }

        echo view('tests.loading');
        $plans = Plan::all();
//        sleep(3);
        //        echo view('plans.list');
        echo '<script>
                    while (document.body.firstChild) {
                        document.body.removeChild(document.body.firstChild);
                    }</script>';
        return view('plans.list')->with('plans', $plans);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plans.form')->with('Model', new Plan());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->request->parameters);
        $plan = Plan::create($request->request->all());
        Session::flash('message', "Plano $plan->name com valor $plan->value criado com sucesso.");
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('plans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        return view('plans.form')->with('plan', $plan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        $plan->update($request->request->all());
        return redirect()->route('plans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();
    }
}
