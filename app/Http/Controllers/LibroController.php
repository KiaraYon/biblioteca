<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use App\Models\Libro;
use App\Models\Autor;
use App\Models\Editorial;
use App\Models\Materium;
use Illuminate\Http\Request;

/**
 * Class LibroController
 * @package App\Http\Controllers
 */
class LibroController extends Controller
{

        public function __construct()
    {
        $this->middleware('permission:ver-libros')->only(['index', 'show']);
        $this->middleware('permission:crear-libros')->only(['create', 'store']);
        $this->middleware('permission:editar-libros')->only(['edit', 'update']);
        $this->middleware('permission:eliminar-libros')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $libros = Libro::with(['autor', 'editorial', 'materium']);

        if ($search) {
            $libros = $libros->where('titulo', 'like', '%' . $search . '%')
                            ->orWhereHas('autor', function ($query) use ($search) {
                                $query->where('autor', 'like', '%' . $search . '%');
                            })
                            ->orWhereHas('editorial', function ($query) use ($search) {
                                $query->where('editorial', 'like', '%' . $search . '%');
                            })
                            ->orWhereHas('materium', function ($query) use ($search) {
                                $query->where('nombre', 'like', '%' . $search . '%');
                            });
        }

        $libros = $libros->paginate();

        return view('libro.index', compact('libros'))
                ->with('i', (request()->input('page', 1) - 1) * $libros->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $libro = new Libro();
        $autores = Autor::pluck('autor','id');
        $editoriales = Editorial::pluck('editorial','id');
        $materias = Materium::pluck('nombre','id');
        return view('libro.create', compact('libro','autores','editoriales','materias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info('Request recibida', $request->all()); // Usa Log::info para debug

        try {
            // Manejo de la carga de la imagen primero
            $fileName = 'noimage.jpg'; // Valor por defecto
            if ($request->hasFile('imagen')) {
                $path = $request->file('imagen')->store('uploads', 'public');
                $fileName = basename($path);
            }

            // Ahora la validación de los otros datos
            $validatedData = $request->validate([
                'cantidad' => 'required',
                'titulo' => 'required',
                'id_autor' => 'required',
                'id_editorial' => 'required',
                'id_materia' => 'required',
                'anio_edicion' => 'nullable|date',
                'num_pagina' => 'nullable|numeric',
                'descripcion' => 'nullable|string',
                'estado' => 'required',
                // Notar que 'imagen' no se valida aquí ya que se manejó arriba
            ]);

            // Agregar el nombre de la imagen al array de datos validados
            $validatedData['imagen'] = $fileName;

            // Crear un nuevo libro
            Libro::create($validatedData);
            return redirect()->route('libros.index')->with('success', 'Libro creado con éxito.');
        } catch (\Exception $e) {
            Log::error("Error al crear libro: " . $e->getMessage());
            return redirect()->back()->withErrors(['msg' => 'Error al crear el libro.']);
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
        $libro = Libro::find($id);

        return view('libro.show', compact('libro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $libro = Libro::find($id);
        $autores = Autor::pluck('autor','id');
        $editoriales = Editorial::pluck('editorial','id');
        $materias = Materium::pluck('nombre','id');

        return view('libro.edit', compact('libro','autores','editoriales','materias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Libro $libro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Libro $libro)
    {
         Log::info('Request recibida', $request->all()); // Usa Log::info para debug
        try {
            // Validar todos los campos juntos
            $validatedData = $request->validate([
                'cantidad' => 'required',
                'titulo' => 'required',
                'id_autor' => 'required',
                'id_editorial' => 'required',
                'id_materia' => 'required',
                'anio_edicion' => 'nullable|date',
                'num_pagina' => 'nullable|numeric',
                'descripcion' => 'nullable|string',
                'estado' => 'required',
                'imagen' => 'image|nullable|max:1999',
            ]);

            Log::info('Despues de Validar todos los campos juntos');

            // Manejo de la carga de la imagen
            if ($request->hasFile('imagen')) {
                Log::info('Si existe una imagen anterior y no');
                // Si existe una imagen anterior y no es 'noimage.jpg', la eliminamos
                if ($libro->imagen && $libro->imagen != 'noimage.jpg') {
                    Storage::delete('public/uploads/' . $libro->imagen);
                }
                Log::info('Guardar la nueva imagen y actualizar el nombre de la imagen en los datos validados');
                // Guardar la nueva imagen y actualizar el nombre de la imagen en los datos validados
                $path = $request->file('imagen')->store('uploads', 'public');
                $validatedData['imagen'] = basename($path);
            } else {
                // Si no se sube una nueva imagen, mantenemos la antigua
                Log::info('Si no se sube una nueva imagen, mantenemos la antigua');
                $validatedData['imagen'] = $libro->imagen;
            }

            // Actualizar el libro con los datos validados
            $libro->update($validatedData);
            Log::info('Actualizar el libro con los datos validados');
            return redirect()->route('libros.index')->with('success', 'Libro actualizado con éxito.');
        } catch (\Exception $e) {
            Log::error("Error al actualizar libro: " . $e->getMessage());
            return redirect()->back()->withErrors(['msg' => 'Error al actualizar el libro.']);
        }
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $libro = Libro::find($id)->delete();

        return redirect()->route('libros.index')
            ->with('success', 'Libro deleted successfully');
    }
}
