<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Categorie;
use App\Models\Course;
use App\Models\Level;
use App\Models\Price;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class CreateCurso extends Component
{
    use WithFileUploads;

    public $photo, $imagen;
    public $curso, $title, $subtitle, $slug, $description, $categorie_id, $price_id, $level_id;
    // 'email' => 'required|string|min:2|max:50|unique:imporcomex.emails,email',
    protected $rules = [
        'title' => 'required',
        'subtitle' => 'required',
        'slug' => 'required|unique:cursos.courses,slug',
        'description' => 'required',
        'categorie_id' => 'required',
        'price_id' => 'required',
        'level_id' => 'required',
        'photo' => 'required|image|max:1024',
    ];
    public function render()
    {
        $categorias = Categorie::all();
        $niveles = Level::all();
        $precios = Price::all();
        return view('livewire.instructor.create-curso', compact('categorias', 'niveles', 'precios'));
    }
    public function create()
    {
        $this->validate();
        try {

            $url = $this->photo->store('cursos', 'public');
            $curso = Course::create([
                'title' => $this->title,
                'subtitle' => $this->subtitle,
                'description' => $this->description,
                'slug' => $this->slug,
                'user_id' => auth()->user()->id,
                'level_id' => $this->level_id,
                'categorie_id' => $this->categorie_id,
                'price_id' => $this->price_id
            ]);
            $curso->image()->create([
                'url' => $url
            ]);

            $this->emit('alert', 'Registro creado con exito!');
            return redirect()->route('instructor.cursos.admin.show', $curso->id);
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }
    public function slugChange()
    {

        $this->slug = Str::slug($this->title);
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
}
