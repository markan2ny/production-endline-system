<?php

namespace App\Http\Livewire;

use App\Models\Style;
use Livewire\Component;
use App\Models\ModelEntry;
use Illuminate\Support\Facades\DB;

class StyleModel extends Component
{
    public $styles = null, $models = null;
    public $selectedStyle = null;

    public function mount() {
        $this->styles = DB::table('styles')->orderBy('id')->get();
    }
    public function render() {
        return view('livewire.style-model')->layout('livewire.layouts.app');
    }
    public function updatedselectedStyle($styles) {
        $this->models = ModelEntry::where('style_id', $styles)->get();
    }
}
