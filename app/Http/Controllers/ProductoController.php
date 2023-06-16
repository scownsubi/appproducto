<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $producto = Producto::all();
        //$dataProducto = DB::table('producto')->get();
        return view('listar', compact('producto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('crear');
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
        $storeData = $request->validate([
            'nombre' => 'required|max:255',
            'codigo' => 'required|max:255',
            'descripcion' => 'required|max:255',
            'precio' => 'required|numeric',
            'path' => 'required|max:255',
        ]);
        $producto = Producto::create($storeData);
        return redirect('/productos')->with('completed', 
        'Producto registrado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('editar', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        echo "<br>hola<br>";
        $updateData = $request->validate([
            'nombre' => 'required|max:255',
            'codigo' => 'required|max:255',
            'descripcion' => 'required|max:255',
            'precio' => 'required|numeric',
            'path' => 'required|max:255',
        ]);
        Producto::whereId($id)->update($updateData);
        return redirect('/productos')->with('Completado', 
        'Registro actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect('/productos')->with('Completado', 'Producto eliminado correctamente');
    }
}
