<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function getModel(Request $request) { return "\\App\\Models\\" . substr(ucfirst(explode('/', $request->getRequestUri())[1]), 0, -1); }
    public function getRoute(Request $request) { return explode('/', $request->getRequestUri())[1]; }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Model = $this->getModel($request);
        $route = $this->getRoute($request);
        return view('list')->with('objects', $Model::all())->with('Model', new $Model());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $Model = $this->getModel($request);
        $route = $this->getRoute($request);
        return view('form')->with('Model', new $Model());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Model = $this->getModel($request);
        $route = $this->getRoute($request);
        $object = $Model::create($request->request->all());
        return redirect()->route("$route.edit", ['object' => $object->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Contract $object)
    {
        $Model = $this->getModel($request);
        $route = $this->getRoute($request);
        return view('form')->with('object', $object)->with('Model', new $Model());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Contract $object)
    {
        $Model = $this->getModel($request);
        $route = $this->getRoute($request);
        return view('form')->with('object', $object)->with('Model', new $Model());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $object)
    {
        $Model = $this->getModel($request);
        $route = $this->getRoute($request);
        $object->update($request->request->all());
        return view('form')->with('object', $object)->with('Model', new $Model());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Contract $object)
    {
        $Model = $this->getModel($request);
        $route = $this->getRoute($request);
        $object->delete();
        return redirect()->route("$route.index");
    }
}
