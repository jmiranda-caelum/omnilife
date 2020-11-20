<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()){
            $database = DB::connection('mysql');
            $employees_data = $database->table('empleados')
                                        ->select()
                                        ->get();
            return view('home', ["employees_data"=>$employees_data]);
        }
        return redirect()->route('login');
    }

    public function add_employees(Request $request){

        if (Auth::check())
        {
            $action = '';
            if($request->has('action')){
                $database = DB::connection('mysql');

                // Validate fields
                if (!$request->has('codigo') || !$request->has('nombre') || !$request->has('salarioPesos') || !$request->has('salarioDolares') || !$request->has('direccion') || !$request->has('estado') || !$request->has('ciudad') || !$request->has('telefono') || !$request->has('correo') || !$request->has('activo')) {
                    return redirect()->route('home', ['action_msg' => 'Error']);
                }
                // Actualiza
                if(@$request->has('idemployee') && $request->input('idemployee') != ''){
                   
                    $action = 'update';

                        DB::table('empleados')
                            ->where([
                                    ['id', '=', $request->input('idemployee')],
                            ])
                            ->update(
                                [
                                    'codigo' => $request->input('codigo'), 
                                    'nombre' => $request->input('nombre'), 
                                    'salarioPesos' => $request->input('salarioPesos'), 
                                    'salarioDolares' => $request->input('salarioDolares'), 
                                    'direccion' => $request->input('direccion'),
                                    'estado' => $request->input('estado'),
                                    'ciudad' => $request->input('ciudad'),
                                    'telefono' => $request->input('telefono'), 
                                    'correo' => $request->input('correo'), 
                                    'activo' => $request->input('activo'),
                                ]
                            );

                }else{ // Agrega
                  
                    $action = 'add';
                    DB::table('empleados')->insert(
                        [
                            'codigo' => $request->input('codigo'), 
                            'nombre' => $request->input('nombre'), 
                            'salarioPesos' => $request->input('salarioPesos'), 
                            'salarioDolares' => $request->input('salarioDolares'), 
                            'direccion' => $request->input('direccion'),
                            'estado' => $request->input('estado'),
                            'ciudad' => $request->input('ciudad'),
                            'telefono' => $request->input('telefono'), 
                            'correo' => $request->input('correo'),
                            'activo' => $request->input('activo')
                        ]
                    );
                }
            }

            return redirect()->route('home', ['action_msg' => $action]);
        }
        
        return redirect()->route('login');
    }


    public function del_employee(Request $request){

        if (Auth::check())
        {
            if($request->has('action') && $request->has('id')){
                $database = DB::connection('mysql');
                DB::table('empleados')
                    ->where([
                        ['id', '=', $request->input('id')],
                    ])
                    ->update(
                        [
                            'activo' => '0',
                        ]
                    );                    
            }
        }
        
        return redirect()->route('login');
    }

    public function activate_employee(Request $request){

        if (Auth::check())
        {
            if($request->has('action') && $request->has('id')){
                $database = DB::connection('mysql');
                DB::table('empleados')
                    ->where([
                        ['id', '=', $request->input('id')],
                    ])
                    ->update(
                        [
                            'activo' => '1',
                        ]
                    );                    
            }
        }
        
        return redirect()->route('login');
    }

    public function get_employee(Request $request){
        if (Auth::check())
        {
            if($request->has('action') && $request->input('id') != ''){
                $database = DB::connection('mysql');
                $id = $request->input('id');
                
                $employee_data = $database->table('empleados')
                                    ->select()
                                    ->where('id', '=', $id)
                                    ->first();

                return Response::json(array('employee_data_json' => $employee_data));
            }
        }

        return redirect()->route('login');
    }

    public function get_rate(){
        if (Auth::check())
        {
            $today = date('Y-m-d');
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://www.banxico.org.mx/SieAPIRest/service/v1/series/SF43718/datos/$today/$today",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_HTTPHEADER => array(
                "Bmx-Token: 0fce7d85c76c9afa6f8ef05f95d50a11c62573c637d28706e28f2a81e84264e5",
                "Cookie: ser9108090=3327084202.39455.0000; TS0175f232=0189f484afe455fc58c63ed62abc6e4187e46ffa3cb5614b8d703be3ebce99296d0d8dbb80541e3a33cdf112ed02597f1733ba36314f7599ca6d9821049cfe26e623df83a9"
              ),
            ));

            $response = curl_exec($curl);
            $json_rate = json_decode($response, true);
            curl_close($curl);
            return Response::json($json_rate);
        }
    }

    public function check_code(Request $request){
        if (Auth::check())
        {
            if($request->has('action') && $request->input('code') != ''){
                $database = DB::connection('mysql');
                $code = $request->input('code');

                $code_count = DB::table('empleados')
                                        ->where([
                                            ['codigo', '=', $code],
                                        ])
                                        ->count();
                
               if ($code_count == 0) {
                    echo 0;
                    return;
               }else{
                    echo 1;
                    return;
               }


            }else{
                echo 0;
                return;
            }
        }

        return redirect()->route('login');
    }
}
