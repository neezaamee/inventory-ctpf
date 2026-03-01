<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Officer;

class OfficerController extends Controller
{
    public function index(Request $request)
    {
        $query = Officer::query();
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('belt_number', 'like', '%' . $request->search . '%')
                  ->orWhere('rank', 'like', '%' . $request->search . '%')
                  ->orWhere('contact_no', 'like', '%' . $request->search . '%');
        }
        $officers = $query->paginate(10);
        return view('officers.index', compact('officers'));
    }

    public function create()
    {
        $ranks = \App\Models\Rank::all();
        return view('officers.create', compact('ranks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'rank' => 'required|string|max:100',
            'belt_number' => 'required|string|max:50|unique:officers,belt_number',
            'posting' => 'nullable|string|max:255',
            'contact_no' => 'nullable|string|max:20',
        ]);

        Officer::create($validated);

        return redirect()->route('officers.index')->with('success', 'Officer profile created successfully.');
    }

    public function edit(Officer $officer)
    {
        $ranks = \App\Models\Rank::all();
        return view('officers.edit', compact('officer', 'ranks'));
    }

    public function update(Request $request, Officer $officer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'rank' => 'required|string|max:100',
            'belt_number' => 'required|string|max:50|unique:officers,belt_number,' . $officer->id,
            'posting' => 'nullable|string|max:255',
            'contact_no' => 'nullable|string|max:20',
        ]);

        $officer->update($validated);

        return redirect()->route('officers.index')->with('success', 'Officer profile updated successfully.');
    }

    public function destroy(Officer $officer)
    {
        $officer->delete();

        return redirect()->route('officers.index')->with('success', 'Officer profile deleted successfully.');
    }
}
