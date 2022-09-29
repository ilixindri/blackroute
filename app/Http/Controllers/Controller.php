<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
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
    public function api(Request $request) {
        if(strpos($request->getRequestUri(), 'api') !== false) {
            $this->api = true;
        } else {
            $this->api = false;
        }
    }
    public function getModels(Request $request) {
        $Models = [];
        $aux = explode('/', $request->getRequestUri());
        foreach ($aux as $key => $value) {
            $value = explode('?', $value);
            if(is_array($value)) { $value = $value[0]; }
            if (!is_numeric($value) && !in_array($value, ['create', 'edit', '', 'api'])) {
                $pattern = '/^(http|https):\/\/(www\.)?(\w+)\.(\w+)\/api\/tests\/(\w+)\/(\w+)$/';
                if(($this->api && !in_array($value, [end($aux), 'tests'])) || !$this->api) {
                    if(substr($value,-2,2) == 'es') { $Models[] = substr($value, 0, -2); }
                    else { $Models[] = substr($value, 0, -1); }
                }
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
    public function loading(Request $request, $id=NULL) {
        $this->api($request);
        $this->object = [];
        $this->Models = $this->getModels($request);
        if(count($this->Models) == 1) {
            $this->objects = $this->Models[0]::all();
            $this->Model = new $this->Models[0]();
            if($id!=NULL) $this->object = $this->Models[0]::find($id);
//            dd($this->object);
        } else {
            $last_index = count($this->Models) - 1;
            $this->objects = $this->Models[$last_index]::where($this->Models[0].'_id', $id)->get();
            $this->Model = new $this->Models[$last_index]();
            $this->object = "\\App\\Models\\" . ucfirst($this->Models[0]);
            $this->object = $this->object::find($id);
        }
        $this->route = $this->getRoute($request);
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id=NULL)
    {
        $load = $this->loading($request, $id);
        return view('list')->with('objects', $this->objects)->with('Model', $this->Model)->with('object', $this->object)->with('route', $this->route);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id=NULL)
    {
        $load = $this->loading($request, $id);
        return view('form')->with('objects', $this->objects)->with('Model', $this->Model)->with('object', $this->object)->with('route', $this->route);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id=NULL)
    {
        $this->loading($request, $id);
        if ($this->route == 'clients.carnets') { $request->client = $this->object;
            $this->object = (new Banking\GerenciaNet\CarnetController())->create($request);
            $request->carnet = $this->object['data'];
            $aux = (new GerenciaNet\CarnetController())->store($request);
            foreach ($request->carnet['charges'] as $key => $charge) {
                $request->charge = $charge;
                (new GerenciaNet\BilletController())->store($request);
            }
        }
        elseif ($this->route == 'clients') {
            $this->object = $this->Model::create($request->request->all());
            $request->request->set('client_id', $this->object->id);
            if(is_array($request->request->all()['contract_id'])) {
                $contract_ids = $request->request->all()['contract_id'];
                foreach ($contract_ids as $key => $contract_id) {
                    $request->request->set('contract_id', $contract_id);
                    Agreement::create($request->request->all());
                }
            } else {
                Agreement::create($request->request->all());
            }
        }
        else { $this->object = $this->Model::create($request->request->all()); }
        return redirect()->route($this->route.".edit", [substr($this->route, 0, -1) => $this->object->id])->with('objects', $this->objects)
            ->with('Model', $this->Model)->with('object', $this->object)->with('route', $this->route);
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
        $load = $this->loading($request, $id);
        if($this->api) {
            return json_encode($this->object);
        } else {
            return view('form')->with('objects', $this->objects)->with('Model', $this->Model)->with('object', $this->object)->with('route', $this->route);
        }
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
        $load = $this->loading($request, $id);
        return view('form')->with('objects', $this->objects)->with('Model', $this->Model)->with('object', $this->object)->with('route', $this->route);
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
        $load = $this->loading($request, $id);
        $this->object->update($request->request->all());
        return view('form')->with('objects', $this->objects)->with('Model', $this->Model)->with('object', $this->object)->with('route', $this->route);
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
        $load = $this->loading($request, $id);
        $this->object->delete();
        return redirect()->route($this->route.".index")->with('objects', $this->objects)->with('Model', $this->Model)->with('object', $this->object)->with('route', $this->route);
    }
    public function tests(Request $request, $var=NULL)
    {
        $this->loading($request);
        return json_encode($this->Model->$var);
    }
}
