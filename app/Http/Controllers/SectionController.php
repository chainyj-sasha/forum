<?php

namespace App\Http\Controllers;

use App\Models\Section;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::all();

        return view('section.index', [
            'title' => 'Разделы форума',
            'sections' => $sections,
        ]);
    }
}
