<?php

namespace App\Http\Livewire\Page;

use Livewire\Component;

use App\Models\Page;

class Edit extends Component
{
    public Page $page;
    public $page_id;
    public $title;
    public $content;
    public $is_homepage;

    public function mount(Page $page)
    {
        $this->page = $page;
        $this->page_id = $page->page_id;
        $this->title = $page->title;
        $this->is_homepage = $page->is_homepage;
        $this->content = $page->content;
    }

    public function render()
    {
        return view('livewire.page.edit')
            ->layout('layouts.app');
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'title' => 'required',
            'content' => 'required',
        ]);
    }

    public function update()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $updatedPage = $this->page->updateOrCreate(
            ['id' => $this->page_id],
            [
                'title' => $this->title,
                'content' => $this->content,
                'is_homepage' => $this->is_homepage,
            ]
        );
        
        session()->flash('flash.banner', 'Page updated!');
        session()->flash('flash.bannerStyle', 'success');
        
        $this->page = $updatedPage;
    }
}
