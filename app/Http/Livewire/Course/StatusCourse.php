<?php

namespace App\Http\Livewire\Course;

use App\Models\Course;
use App\Models\Lesson;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class StatusCourse extends Component
{
    use AuthorizesRequests;

    public $curso, $current;
    protected $listeners = ['change'];
    private $changeCalled = false;
    public $currentLesson;


    public function mount(Course $curso)
    {
        $this->curso = $curso;

        // Obtener las lecciones completadas por el usuario en orden de completitud en la tabla pivote
        $completedLessons = $curso->lessons()
            ->join('lesson_user', 'lessons.id', '=', 'lesson_user.lesson_id')
            ->where('lesson_user.user_id', auth()->user()->id)
            ->orderBy('lesson_user.id', 'desc')
            ->select('lessons.*')
            ->get();

        // Si hay lecciones completadas, tomar la última en términos de completitud
        if ($completedLessons->isNotEmpty()) {
            $this->current = $completedLessons->first();
        } else {
            // Si no hay lecciones completadas, buscar la primera no completada
            foreach ($curso->lessons as $lesson) {
                if (!$lesson->completed) {
                    $this->current = $lesson;
                    break;
                }
            }

            // Si todas las lecciones están completadas, tomar la última
            if (!$this->current) {
                $this->current = $curso->lessons->last();
            }
        }

        // Verificar si el usuario está inscrito en el curso
        if (!$curso->students->contains(auth()->user()->id)) {
            $curso->students()->attach(auth()->user()->id);
        }
    }



    public function render()
    {
        return view('livewire.course.status-course');
    }

    public function changeLesson(Lesson $lesson)
    {
        $this->current = $lesson;
        // En tu componente de Livewire, cuando cambies de video, emite el evento
        $this->emit('cambioDeVideo');

        // $this->emit('cambiar',$this->current->iframe);
    }


    public function stateLesson()
    {
        if ($this->current->completed) {
            $this->current->users()->detach(auth()->user()->id);
        } else {
            $this->current->users()->attach(auth()->user()->id);
        }

        $this->current = Lesson::find($this->current->id);
        $this->curso = Course::find($this->curso->id);
    }

    public function getIndexProperty()
    {
        return $this->curso->lessons->pluck('id')->search($this->current->id);
    }
    public function getPreviousProperty()
    {
        if ($this->index == 0) {
            return null;
        } else {
            return $this->curso->lessons[$this->index - 1];
        }
    }
    public function change()
    {

        if (!$this->current->completed) {
            $this->current->users()->attach(auth()->user()->id);
        }

        $this->current = Lesson::find($this->current->id);
        $this->curso = Course::find($this->curso->id);
        $this->emit('update', 'actualizar');
    }
    public function getNextProperty()
    {
        if ($this->index == $this->curso->lessons->count() - 1) {
            return null;
        } else {
            return $this->curso->lessons[$this->index + 1];
        }
    }

    public function getAdvanceProperty()
    {
        $i = 0;
        foreach ($this->curso->lessons as $lesson) {
            if ($lesson->completed) {
                $i++;
            }
        }
        $advance = ($i * 100) / $this->curso->lessons->count();
        return round($advance, 2);
    }

    public function download()
    {
        try {
            $this->emit('alert', 'Recurso descargado con exito!');
            return response()->download(storage_path('app/public/' . $this->current->resource->url));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
