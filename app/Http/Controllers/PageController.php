<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;

class PageController extends Controller
{
    public function home()
    {
        $page = Page::where('is_homepage', true)->first();

        return view('livewire.page.show', compact('page'));
    }
}
