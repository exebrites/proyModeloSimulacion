<?php

namespace App\Http\Controllers\Integrador;

use App\Http\Controllers\Controller;
use App\Models\Integrador\Stock;
use App\Models\Integrador\Movimiento;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class IntegradorController extends Controller
{
    //Vista principal del integrador
    public function index()
    {
        return view('Integrador.index');
    }


    //Vista index de stock
    public function stockIndex()
    {
        // Aqui debo cargar todos los datos de stock necesarios

        $stocks = Stock::all(); // Obtener todos los registros de stock

        return view('Integrador.stock.index', compact('stocks'));
    }

    //Vista para crear un nuevo stock
    public function stockCreate()
    {
        // Aqui debo cargar los datos necesarios para crear un nuevo stock

        return view('Integrador.stock.create');
    }

        // Almacenar nuevo stock y crear movimiento
    public function stockStore(Request $request)
    {
        // Validación de datos
        $validated = $request->validate([
            'producto' => 'required|string|max:255',
            'cantidad_actual' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            // Crear el stock
            $stock = Stock::create([
                'producto' => $validated['producto'],
                'cantidad_actual' => $validated['cantidad_actual'],
            ]);

            // Crear el movimiento asociado (ingreso inicial)
            $movimiento = Movimiento::create([
                'stock_id' => $stock->id,
                'tipo' => 'ingreso_inicial',
                'cantidad' => $validated['cantidad_actual'],
                'venta_id' => null, // No aplica en este caso
                'pedido_id' => null, // No aplica en este caso
            ]);


            DB::commit();

            return redirect()->route('integrador.stock.index')
                             ->with('success', 'Stock registrado exitosamente!');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return back()->withInput()->with('error', 'Error al registrar el stock: ' . $e->getMessage());

        }
    }


}
