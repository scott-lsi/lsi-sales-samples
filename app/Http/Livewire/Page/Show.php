<?php

namespace App\Http\Livewire\Page;

use Livewire\Component;

use App\Models\Page;

class Show extends Component
{
    public Page $page;
    public $slug;

    public function mount(Page $page)
    {
        if(!request()->route('page')){
            $this->page = Page::where('is_homepage', true)->first();
        } else {
            $this->page = $page;
        }
    }

    public function render()
    {
        return view('livewire.page.show')
            ->layout('layouts.guest');
    }
}
