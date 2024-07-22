<?php

namespace App\Http\Controllers;

use App\Models\Editorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class EditorialController
 * @package App\Http\Controllers
 */
class EditorialController extends Controller
{
        public function __construct()
    {
        $this->middleware('permission:ver-editoriales')->only(['index', 'show']);
        $this->middleware('permission:crear-editoriales')->only(['create', 'store']);
        $this->middleware('permission:editar-editoriales')->only(['edit', 'update']);
        $this->middleware('permission:eliminar-editoriales')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        if ($search) {
            $editorials = Editorial::where('editorial', 'like', "%{$search}%")
                                    ->paginate(5);
        } else {
            $editorials = Editorial::paginate(5);
        }

        return view('editorial.index', compact('editorials'))
            ->with('i', (request()->input('page', 1) - 1) * $editorials->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $editorial = new Editorial();
        return view('editorial.create', compact('editorial'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info('store');
        Log::info($request);
        request()->validate(Editorial::$rules);

        $editorial = Editorial::create($request->all());

        return redirect()->route('editoriales.index')
            ->with('success', 'Editorial created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $editorial = Editorial::find($id);

        return view('editorial.show', compact('editorial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editorial = Editorial::find($id);

        return view('editorial.edit', compact('editorial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Editorial $editorial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Editorial $editorial)
    {

        request()->validate(Editorial::$rules);

        // $editorial->id =$request->id;
        $editorial = Editorial::find($request->id);

        $editorial->editorial = $request->editorial;
        $editorial->estado = $request->estado;
        $editorial->save();


        return redirect()->route('editoriales.index')
            ->with('success', 'Editorial updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $editorial = Editorial::find($id)->delete();

        return redirect()->route('editoriales.index')
            ->with('success', 'Editorial deleted successfully');
    }
}