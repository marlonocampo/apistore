<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ProductoController extends Controller
{
    public function Insertar(Request $datos)
    {
        try {
            foreach ($datos->all() as $producto) {
                $newProducto = new Producto();
                $newProducto->nombre = $producto['nombre'];
                $newProducto->stock = $producto['stock'];
                $newProducto->precio = $producto['precio'];
                $newProducto->codigo = $producto['codigo'];
                $newProducto->idcategoria = $producto['categoria_id'];
                $newProducto->descripcion = $producto['descripcion'];
                $newProducto->activo = 1;
                $newProducto->fechacreacion = Carbon::parse($producto['fechaingreso'])->format('Y-m-d');
                $newProducto->save();
            }
            return ProductoController::Responses(true, 'Producto(s) Insertado');
        } catch (Exception $e) {
            return ProductoController::Responses(false, $e);
        }
    }

    public function Listar()
    {
        $listaProductos = DB::table('producto as p')
            ->join('categoria as c', 'p.idcategoria', '=', 'c.id')
            ->select('p.*', 'c.nombre as nombrecategoria')
            ->get();
        return response()->json(["exito" => true, "productos" => $listaProductos]);
    }

    public function Actualizar(Request $datosActuales)
    {
        try {
            $idProducto = $datosActuales['id'];
            $filasAffec = DB::table('producto')
                ->where('id', $idProducto)
                ->update(
                    [
                        'nombre' => $datosActuales['nombre'],
                        'stock' => $datosActuales['stock'],
                        'precio' => $datosActuales['precio'],
                        'fechacreacion' => Carbon::parse($datosActuales['fechacreacion'])->format('Y-m-d'),
                        'idcategoria' => $datosActuales['idCategoria'],
                        'descripcion' => $datosActuales['descripcion'],
                    ]
                );
            return $this->Responses(true, "Datos actualizado!: Filas afectadas " . $filasAffec);
        } catch (Exception $e) {
            return $this->Responses(false, $e);
        }
    }

    public function Responses($exito, $msj, $datos = [])
    {
        if (!$exito) {
            Log::debug("Error API: " . $msj->getMessage());
            $msj = $msj->getMessage();
        }

        return response()->json([
            "exito" => $exito,
            "msj" => $msj,
            "datos", $datos
        ]);
    }
}


//Carbon::today()->format('y-m-d') => para guarda el dia actual en que estamos haciendo el registro