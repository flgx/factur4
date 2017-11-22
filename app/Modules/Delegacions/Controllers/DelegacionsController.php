<?php

namespace FI\Modules\Delegacions\Controllers;
use FI\Http\Controllers\Controller;

use App\Models\Delegacions;
use Request;
use Flash;
use Input;
use Redirect;
use Validator;
use View;

class DelegacionsController extends Controller
{


    public function veurecreardelegacions()
    {
        $this->authorize(__FUNCTION__, Delegacions::class);
        return View::make('delegacions/crearDelegacio');
    }

    public function creardelegacions()
    {
        $this->authorize(__FUNCTION__, Delegacions::class);
        $data = Input::all();
        $rules = array(
            'nom' => 'required',
            'CP' => 'required',
            'poblacio' => 'required',
            'provincia' => 'required',
            'telefon' => 'required',
            'email' => 'required',
            'fax' => 'required',
            'responsable' => 'required',
        );
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            Flash::error('Ha hagut un problema. Si us plau, torneu a intentar-ho passat un moment.');
            return Redirect::to('delegacions/crear');
        } else {

            $delegacio = new Delegacions();

            $delegacio->nom = Input::get('nom');
            $delegacio->CP = Input::get('CP');
            $delegacio->poblacio = Input::get('poblacio');
            $delegacio->provincia = Input::get('provincia');
            $delegacio->telefon = Input::get('telefon');
            $delegacio->email = Input::get('email');
            $delegacio->fax = Input::get('fax');
            $delegacio->responsable = Input::get('responsable');

            $delegacio->save();

            Flash::success('Delegació creada correctament.');
            return Redirect::to('delegacions');
        }
    }

    public function llistardelegacions(Builder $htmlBuilder)
    {
        $this->authorize(__FUNCTION__, Delegacions::class);

        $DataTable = $htmlBuilder
            ->addColumn(['data' => 'nom', 'name' => 'nom', 'title' => 'nom'])
            ->addColumn(['data' => 'responsable', 'name' => 'responsable', 'title' => 'responsable'])
            ->addColumn(['data' => 'telefon', 'name' => 'telefon', 'title' => 'telefon'])
            ->addColumn(['data' => 'email', 'name' => 'email', 'title' => 'email'])
            ->addColumn(['data' => 'accions', 'name' => 'accions', 'title' => 'accions', 'bSearchable' => false])
            ->parameters(['iDisplayLength' => '25'])
            ->parameters(config('datatables.locale'))
            ->ajax(action('DelegacionsController@data'));

        return view()->make('delegacions.llistarDelegacions', compact('DataTable'));
    }

    /**
     * Data listing of the resource for DataTables.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $this->authorize(__FUNCTION__, Delegacions::class);
        return app('datatables')
            ->of(Delegacions::where('is_active', 1))
            ->editColumn('accions', function ($delegacions) {
                $html = "<a href='" . url('delegacions/veure/' . $delegacions->id) . "' data-balloon=\"Veure la delegació\" data-balloon-pos=\"up\">
                            <span class='label label-success'><i class='fa fa-search-plus'></i></span>
                          </a>";
                if(\Auth::user()->hasRole(['Coordinador', 'Admin'])) {
                    $html .= "<a href='" . url('delegacions/editar/' . $delegacions->id) . "' data-balloon=\"Editar la delegació\" data-balloon-pos=\"up\">
                            <span class='label label-warning'><i class='fa fa-pencil'></i></span>
                          </a>";
                    $html .= "<a href=\"#deleteModal\" data-toggle=\"modal\" title=\"Delete\" data-url=\"" . url('delegacions/esborrar') . "\" data-id=\"" . $delegacions->id . "\" data-target=\"#deleteModal\" data-balloon=\"Esborrar la delegació\" data-balloon-pos=\"up\">
                            <span class='label label-danger'><i class='fa fa-trash'></i></span>
                          </a>";
                }
                return $html;
            })
            ->make(true);
    }

    public function veuredelegacions($id)
    {
        $this->authorize(__FUNCTION__, Delegacions::class);
        $data['delegacions'] = Delegacions::find($id);
        return View::make('delegacions/veureDelegacio', $data);
    }


    public function editardelegacions($id)
    {
        $this->authorize(__FUNCTION__, Delegacions::class);
        $del = Delegacions::find($id);
        return View::make('delegacions/editarDelegacio', compact('del', 'id'));
    }

    public function updatedelegacions($id)
    {
        $this->authorize(__FUNCTION__, Delegacions::class);
        $data = Input::all();
        $rules = array(
            'nom' => 'required',
            'CP' => 'required',
            'poblacio' => 'required',
            'provincia' => 'required',
            'pais' => 'required',
            'telefon' => 'required',
            'email' => 'required',
            'fax' => 'required',
            'responsable' => 'required',
        );
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            Flash::error('Ha hagut un problema. Si us plau, torneu a intentar-ho passat un moment.');
            return Redirect::to('delegacions');
        } else {

            $delegacio = Delegacions::find($id);

            $delegacio->nom = Input::get('nom');
            $delegacio->CP = Input::get('CP');
            $delegacio->poblacio = Input::get('poblacio');
            $delegacio->provincia = Input::get('provincia');
            $delegacio->pais = Input::get('pais');
            $delegacio->telefon = Input::get('telefon');
            $delegacio->email = Input::get('email');
            $delegacio->fax = Input::get('fax');
            $delegacio->responsable = Input::get('responsable');

            $delegacio->save();

            $data['delegacions'] = Delegacions::find($id);
            Flash::success('Delegació editada correctament.');
            return Redirect::to('delegacions/veure/' . $id);
        }
    }

    public function esborrardelegacions($id)
    {
        $this->authorize(__FUNCTION__, Delegacions::class);
        $delegacions = Delegacions::find($id);
        $delegacions->is_active = 0;
        $delegacions->update();

        $data['delegacions'] = Delegacions::where('is_active', 1)->get();
        Flash::success('Delegació esborrada correctament.');
        return Redirect::to('delegacions');
    }
}

