<?php

use App\Support\SiteSettings;
use Illuminate\View\View;
use Livewire\Component;

new class extends Component
{
    public function render(): View
    {
        return $this->view()
            ->layout('layouts::app', [
                'title' => 'Nosotros' . ' - ' . SiteSettings::get('site_name', config('app.name')),
                'description' => 'Este proyecto nace como una iniciativa personal para democratizar el acceso a las encuestas electorales en Perú.',
            ]);
    }
};
