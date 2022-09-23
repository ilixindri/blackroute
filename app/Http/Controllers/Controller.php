<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Cto;
use App\Models\Contract;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function join_paths($args) {
        $paths = array();
        // foreach (func_get_args() as $arg) {
        foreach ($args as $arg) {
            if ($arg !== '') { $paths[] = $arg; }
        }
        return preg_replace('#/+#','/',join('/', $paths));
    }
    public function getModels(Request $request) {
        $Models = [];
        foreach (explode('/', $request->getRequestUri()) as $key => $value) {
            $value = explode('?', $value);
            if(is_array($value)) { $value = $value[0]; }
            if (!is_numeric($value) && $value != 'create' && $value != 'edit' && $value != '') {
                $Models[] = substr($value, 0, -1);
            }
        }
        $last_index = count($Models) - 1;
        $Models[$last_index] = "\\App\\Models\\" . ucfirst($Models[$last_index]);
        return $Models;
    }
    public function getRoute(Request $request) {
        $aux = [];
        foreach (explode('/', $request->getRequestUri()) as $key => $value) {
            $value = explode('?', $value);
            if(is_array($value)) { $value = $value[0]; }
            if (!is_numeric($value) && $value != 'create' && $value != 'edit' && $value != '') {
                $aux[] = $value;
            }
        }
        $route = implode('.', $aux);
        return $route;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id=NULL)
    {
        $object = [];
        $Models = $this->getModels($request);
        if(count($Models) == 1) {
            $objects = $Models[0]::all();
            $Model = new $Models[0]();
        } else {
            $last_index = count($Models) - 1;
            $objects = $Models[$last_index]::where($Models[0].'_id', $id)->get();
            $Model = new $Models[$last_index]();
            $object = "\\App\\Models\\" . ucfirst($Models[0]);
            $object = $object::find($id)->first();
        }
        $route = $this->getRoute($request);
        $Model->route = $route;
        return view('list')->with('objects', $objects)->with('Model', $Model)->with('object', $object);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id=NULL)
    {
        $object = [];
        $Models = $this->getModels($request);
        if(count($Models) == 1) {
            $objects = $Models[0]::all();
            $Model = new $Models[0]();
        } else {
            $last_index = count($Models) - 1;
            $objects = $Models[$last_index]::where($Models[0].'_id', $id)->get();
            $Model = new $Models[$last_index]();
            $object = "\\App\\Models\\" . ucfirst($Models[0]);
            $object = $object::find($id)->first();
        }
        $route = $this->getRoute($request);
        $Model->route = $route;
        return view('form')->with('Model', new $Model())->with('object', $object);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $object = [];
        $Models = $this->getModels($request);
        if(count($Models) == 1) {
            $objects = $Models[0]::all();
            $Model = new $Models[0]();
        } else {
            $last_index = count($Models) - 1;
            $objects = $Models[$last_index]::where($Models[0].'_id', $id)->get();
            $Model = new $Models[$last_index]();
            $object = "\\App\\Models\\" . ucfirst($Models[0]);
            $object = $object::find($id)->first();
        }
        $route = $this->getRoute($request);
        if ($route == 'clients.carnets') { $request->client = $object;
            $object = (new Banking\GerenciaNet\CarnetController())->create($request);
            $request->carnet = $object['data'];
            $aux = (new GerenciaNet\CarnetController())->store($request);
            foreach ($request->carnet['charges'] as $key => $charge) {
                $request->charge = $charge;
                (new GerenciaNet\BilletController())->store($request);
            }
        }
        else { $object = $Model::create($request->request->all()); }
        $Model->route = $route;
        return redirect()->route("$route.edit", ['object' => $object->id]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  ObjectModel  $object
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $object = [];
        $Models = $this->getModels($request);
        if(count($Models) == 1) {
            $objects = $Models[0]::all();
            $Model = new $Models[0]();
        } else {
            $last_index = count($Models) - 1;
            $objects = $Models[$last_index]::where($Models[0].'_id', $id)->get();
            $Model = new $Models[$last_index]();
            $object = "\\App\\Models\\" . ucfirst($Models[0]);
            $object = $object::find($id)->first();
        }
        $route = $this->getRoute($request);
        $object = $Model::find($id)->first();
        $Model->route = $route;
        return view('form')->with('object', $object)->with('Model', new $Model());
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  ObjectModel  $object
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $object = [];
        $Models = $this->getModels($request);
        if(count($Models) == 1) {
            $objects = $Models[0]::all();
            $Model = new $Models[0]();
        } else {
            $last_index = count($Models) - 1;
            $objects = $Models[$last_index]::where($Models[0].'_id', $id)->get();
            $Model = new $Models[$last_index]();
            $object = "\\App\\Models\\" . ucfirst($Models[0]);
            $object = $object::find($id)->first();
        }
        $route = $this->getRoute($request);
        $object = $Model::find($id)->first();
        $Model->route = $route;
        return view('form')->with('object', $object)->with('Model', new $Model());
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  ObjectModel  $object
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $object = [];
        $Models = $this->getModels($request);
        if(count($Models) == 1) {
            $objects = $Models[0]::all();
            $Model = new $Models[0]();
        } else {
            $last_index = count($Models) - 1;
            $objects = $Models[$last_index]::where($Models[0].'_id', $id)->get();
            $Model = new $Models[$last_index]();
            $object = "\\App\\Models\\" . ucfirst($Models[0]);
            $object = $object::find($id)->first();
        }
        $route = $this->getRoute($request);
        $object = $Model::find($id)->first();
        $object->update($request->request->all());
        $Model->route = $route;
        return view('form')->with('object', $object)->with('Model', new $Model());
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  ObjectModel  $object
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $object = [];
        $Models = $this->getModels($request);
        if(count($Models) == 1) {
            $objects = $Models[0]::all();
            $Model = new $Models[0]();
        } else {
            $last_index = count($Models) - 1;
            $objects = $Models[$last_index]::where($Models[0].'_id', $id)->get();
            $Model = new $Models[$last_index]();
            $object = "\\App\\Models\\" . ucfirst($Models[0]);
            $object = $object::find($id)->first();
        }
        $route = $this->getRoute($request);
        $object = $Model::find($id)->first();
        $object->delete();
        $Model->route = $route;
        return redirect()->route("$route.index");
    }
}
