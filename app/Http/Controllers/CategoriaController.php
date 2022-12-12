<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    public function Listar()
    {
        $listaCategorias = DB::table('categoria')->get();

        return response()->json(["Exito" => true, "categorias" => $listaCategorias]);
    }
    
    public function Crear(Request $datos)
    {
        try {
            $newCategoria = new Categoria();
            $newCategoria->nombre = $datos->nombre;
            $newCategoria->fechacreacion = Carbon::today()->format('y-m-d');
            $newCategoria->activo = 1;
            $newCategoria->save();

            return response()->json(['exito' => true]);
        } catch (Exception $exception) {
            return response()->json(['exito' => false, 'msj' => $exception->getMessage()]);
        }
    }
}
