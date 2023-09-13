<?php

namespace App\Http\Livewire\Course;

use App\Models\Course;
use Livewire\Component;

class CourseReviews extends Component
{
    public $curso_id, $rating = 5, $comment;

    public function mount(Course $curso)
    {
        $this->curso_id = $curso->id;
    }
    public function render()
    {
        $curso = Course::find($this->curso_id);
        return view('livewire.course.course-reviews', compact('curso'));
    }

    public function store()
    {
        try {
            $curso = Course::find($this->curso_id);
            $curso->reviews()->create([
                'comment' => $this->comment,
                'rating' => $this->rating,
                'user_id' => auth()->user()->id
            ]);
            $this->emit('alert', 'Reseña publicada con exito!');
        } catch (\Exception $e) {
            dd('error', $e->getMessage());
        }
    }
}
