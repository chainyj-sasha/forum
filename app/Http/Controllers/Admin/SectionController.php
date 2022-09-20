<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminSectionStoreRequest;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function store(AdminSectionStoreRequest $request)
    {
        $section = new Section();
        $section->title = $request->title;
        $section->save();

        return redirect()->route('section.index');
    }
}
