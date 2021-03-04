<?php

namespace App\Http\Livewire\Page;

use Livewire\Component;

use App\Models\Page;

class AdminIndex extends Component
{
    public $pages;
    public $tableTitle;

    public function mount()
    {
        $this->pages = Page::orderBy('title')->get();
        $this->tableTitle = 'Current Pages';
    }

    public function render()
    {
        return view('livewire.page.admin-index')
            ->layout('layouts.app');
    }

    public function delete($page_id)
    {
        Page::find($page_id)->delete();
        
        session()->flash('flash.banner', 'Page deleted!');
        session()->flash('flash.bannerStyle', 'success');

        $this->pages = Page::orderBy('title')->get();
    }

    public function restore($page_id)
    {
        Page::withTrashed()->find($page_id)->restore();
        
        session()->flash('flash.banner', 'Page restored!');
        session()->flash('flash.bannerStyle', 'success');

        $this->pages = Page::orderBy('title')->get();
        $this->tableTitle = 'Current Pages';
    }

    public function destroy($page_id)
    {
        Page::withTrashed()->find($page_id)->forceDelete();
        
        session()->flash('flash.banner', 'Page permanently deleted!');
        session()->flash('flash.bannerStyle', 'success');

        $this->pages = Page::orderBy('title')->onlyTrashed()->get();
        $this->tableTitle = 'Deleted Pages';
    }
    
    public function currentPages()
    {
        $this->pages = Page::orderBy('title')->get();
        $this->tableTitle = 'Current Pages';
    }
    
    public function deletedPages()
    {
        $this->pages = Page::orderBy('title')->onlyTrashed()->get();
        $this->tableTitle = 'Deleted Pages';
    }
}
