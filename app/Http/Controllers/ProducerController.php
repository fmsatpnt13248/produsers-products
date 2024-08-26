<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProducerEditRequest;
use App\Http\Requests\ProducerCreateRequest;
use App\Models\Producer;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProducerController extends Controller
{
    /**
     *
     */
    public function search(Request $request)
    {
        $query = Producer::query();

        if ($request->filled('column') && $request->filled('search')) {
            $query->where($request->column, 'LIKE', '%' . $request->search . '%');
        }

        $results = $query->paginate(15);

        return response()->json($results);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('producers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('producers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProducerCreateRequest $request): RedirectResponse
    {
        Producer::create($request->validated());

        return redirect()->route('producers.index')->with('success', 'Producer added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producer $producer): View
    {
        return view('producers.edit', compact('producer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProducerEditRequest $request, Producer $producer): RedirectResponse
    {
        $producer->update($request->validated());

        return redirect()->route('producers.index')->with('success','Producer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producer $producer)
    {
        $producer->delete();

        return response('Producer deleted successfully');
    }
}
