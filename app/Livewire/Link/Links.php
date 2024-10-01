<?php

namespace App\Livewire\Link;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Links extends Component
{
    public $links = [];
    public $original_url;
    public $slug;
    public $deletingLinkId;
    public $editingLinkId;
    public $editingOriginalUrl;
    public $editingSlug;

    public function mount()
    {
        $this->links = Auth::user()->shortlinks()->orderBy('created_at', 'desc')->get();
    }

    #[On('refresh-links')]
    public function refresh()
    {
        $this->links = Auth::user()->shortlinks()->orderBy('created_at', 'desc')->get();
    }

    #[On('echo:click-count-increment,ClickCount')]
    public function incrementClickCount($event)
    {
        $this->links->map(function ($link) use ($event) {
            if ($link->id == $event['linkId']) {
                $link->click_count = $event['clickCount'];
            }
        });
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
        $this->dispatch('refresh-links');
    }

    public function deleteLink($id)
    {
        $this->deletingLinkId = $id;
    }

    public function confirmDeleteLink()
    {
        Auth::user()->shortlinks()->find($this->deletingLinkId)->delete();
        $this->dispatch('refresh-links');
        $this->deletingLinkId = null;
    }

    public function cancelDeleteLink()
    {
        $this->deletingLinkId = null;
    }

    public function editLink($id)
    {
        $this->editingLinkId = $id;
        $link = $this->links->find($id);
        $this->editingOriginalUrl = $link->original_url;
        $this->editingSlug = $link->slug;
    }

    public function confirmEditLink()
    {
        $this->validate([
            'editingOriginalUrl' => 'required|url',
            'editingSlug' => 'required|string|max:255|unique:shortlinks,slug,' . $this->editingLinkId,
        ]);

        $link = Auth::user()->shortlinks()->find($this->editingLinkId);
        $link->update([
            'original_url' => $this->editingOriginalUrl,
            'slug' => $this->editingSlug,
        ]);
        $this->reset(['editingLinkId', 'editingOriginalUrl', 'editingSlug']);
        $this->dispatch('refresh-links');
    }

    public function cancelEditLink()
    {
        $this->reset(['editingLinkId', 'editingOriginalUrl', 'editingSlug']);
    }

    public function render()
    {
        return view('livewire.link.links');
    }
}
