<?php

namespace App\Http\Livewire\Course;

use App\Models\Course;
use App\Models\Lesson;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class StatusCourse extends Component
{
    use AuthorizesRequests;

    public $curso, $current;

    public function mount(Course $curso)
    {
        $this->curso = $curso;
        foreach ($curso->lessons as $lesson) {
            if (!$lesson->completed) {
                $this->current = $lesson;
                break;
            }
        }

        if (!$this->current) {
            $this->current = $curso->lessons->last();
        }

        $this->authorize('matriculado', $curso);
    }

    public function render()
    {
        return view('livewire.course.status-course');
    }

    public function changeLesson(Lesson $lesson)
    {
        $this->current = $lesson;
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
}
