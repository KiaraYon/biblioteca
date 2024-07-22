<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use App\Models\Autor;
use Illuminate\Http\Request;

/**
 * Class AutorController
 * @package App\Http\Controllers
 */
class AutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($search) {
            $autors = Autor::where('autor', 'like', "%{$search}%")
                            ->paginate(5);
        } else {
            $autors = Autor::paginate(5);
        }

        return view('autor.index', compact('autors'))
            ->with('i', (request()->input('page', 1) - 1) * $autors->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $autor = new Autor();
        return view('autor.create', compact('autor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Separar la validación de la imagen del resto de los datos
            $request->validate([
                'imagen' => 'image|nullable|max:1999',
            ]);

            // Manejo de la carga de la imagen
            if ($request->hasFile('imagen')) {
                $path = $request->file('imagen')->store('uploads', 'public');
                // Guarda solo el nombre del archivo
                $fileName = basename($path);
            } else {
                $fileName = 'noimage.jpg';
            }

            // Validación de los otros datos
            $validatedData = $request->validate([
                'autor' => 'required|string',
                'estado' => 'required',
                // otras reglas si las hay
            ]);

            // Agregar el nombre de la imagen al array de datos validados
            $validatedData['imagen'] = $fileName;

            // Crear un nuevo autor
            Autor::create($validatedData);

            return redirect()->route('autors.index')
                ->with('success', 'Autor creado con éxito.');
        } catch (\Exception $e) {
            Log::error("Error al crear autor: " . $e->getMessage());
            return redirect()->back()->withErrors(['msg' => 'Error al crear autor']);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $autor = Autor::find($id);

        return view('autor.show', compact('autor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $autor = Autor::find($id);

        return view('autor.edit', compact('autor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Autor $autor
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, Autor $autor)
    {
        Log::info('Request Data en Autor', $request->all());
        try {

            $validatedData = $request->validate([
                'autor' => 'required|string',
                'estado' => 'required',
            ]);

            // Manejo de la actualización de la imagen
            if ($request->hasFile('imagen')) {
                // Elimina la imagen anterior si no es la imagen por defecto
                if ($autor->imagen != 'noimage.jpg') {
                    Storage::delete('public/uploads/' . $autor->imagen);
                    Log::info('Imagen anterior eliminada');
                }

                // Sube la nueva imagen y obtén la ruta
                $rutaImagen = $request->file('imagen')->store('uploads', 'public');
                $imagenNombre = basename($rutaImagen); // Obtén solo el nombre del archivo
                $autor->imagen = $imagenNombre; // Actualiza solo el campo imagen
            }

            // Actualizar los datos del autor
            $autor->update($validatedData);

            return redirect()->route('autors.index')
                ->with('success', 'Autor actualizado con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => 'Error al actualizar autor']);
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $autor = Autor::find($id)->delete();

        return redirect()->route('autors.index')
            ->with('success', 'Autor deleted successfully');
    }
}