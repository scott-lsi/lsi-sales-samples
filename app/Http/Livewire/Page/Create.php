<?php

namespace App\Http\Livewire\Page;

use Livewire\Component;

use App\Models\Page;

class Create extends Component
{
    public $title;
    public $content;

    public function render()
    {
        return view('livewire.page.create')
            ->layout('layouts.app');
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'title' => 'required',
            'content' => 'required',
        ]);
    }

    public function create()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        Page::create([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        session()->flash('flash.banner', 'Page created!');
        session()->flash('flash.bannerStyle', 'success');
    }
}
