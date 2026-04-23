<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tarea;

class MostrarTarea extends Component
{
    public function render()
    {
        return view('livewire.mostrar-tarea', [
            'tareas' => Tarea::where('status', 'pendiente')
                ->orderBy('importancia', 'asc')
                ->orderBy('fechaHora', 'asc')
                ->get(),
        ]);
    }

    public function finalizarTarea($tareaId)
    {
        $tarea = Tarea::find($tareaId);
        if ($tarea) {
            $tarea->status = 'finalizado';
            $tarea->save();
        }

        $this->dispatch('notify', 'Tarea finalizada con exito');
    }
}
