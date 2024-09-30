<?php

namespace App\Livewire\Link;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Links extends Component
{
    public $links = [];
    public $original_url;
    public $slug;

    public function mount()
    {
        $this->links = Auth::user()->shortlinks()->orderBy('created_at', 'desc')->get();
    }

    public function createLink()
    {
        $this->validate([
            'original_url' => 'required|url',
            'slug' => 'required|string|max:255|unique:shortlinks,slug',
        ]);

        Auth::user()->shortlinks()->create([
            'original_url' => $this->original_url,
            'slug' => $this->slug,
        ]);
        
        $this->reset(['original_url', 'slug']);
        $this->links = Auth::user()->shortlinks()->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.link.links');
    }
}
