<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Categorie;
use App\Models\Course;
use App\Models\Level;
use App\Models\Price;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class UpdateCurso extends Component
{
    use WithFileUploads;

    public $photo, $imagen;
    public $curso, $title, $subtitle, $slug, $description, $categorie_id, $price_id, $level_id;

    public function rules()
    {
        return [
            'title' => 'required',
            'subtitle' => 'required',
            'slug' => 'required|unique:cursos.courses,slug,' . $this->curso->id,
            'description' => 'required',
            'categorie_id' => 'required',
            'price_id' => 'required',
            'level_id' => 'required',
            'photo' => 'nullable|image|max:1024',
        ];
    }

    public function mount(Course $curso)
    {
        $this->curso = $curso;
        $this->title = $curso->title;
        $this->subtitle = $curso->subtitle;
        $this->slug = $curso->slug;
        $this->description = $curso->description;
        $this->categorie_id = $curso->categorie_id;
        $this->price_id = $curso->price_id;
        $this->level_id = $curso->level_id;
        $this->imagen = $curso->image->url ?? '';
    }

    public function render()
    {
        $categorias = Categorie::all();
        $niveles = Level::all();
        $precios = Price::all();
        return view('livewire.instructor.update-curso', compact('categorias', 'niveles', 'precios'));
    }

    public function slugChange()
    {

        $this->slug = Str::slug($this->title);
    }

    public function update()
    {
        try {
            $this->validate();
            $this->curso->update([
                'title' => $this->title,
                'subtitle' => $this->subtitle,
                'description' => $this->description,
                'slug' => $this->slug,
                'user_id' => auth()->user()->id,
                'level_id' => $this->level_id,
                'categorie_id' => $this->categorie_id,
                'price_id' => $this->price_id
            ]);
            if ($this->photo) {
                $this->imagen = $this->photo->store('cursos', 'public');
                if ($this->curso->image) {
                    Storage::delete('public/' . $this->curso->image->url);
                    $this->curso->image()->update([
                        'url' => $this->imagen
                    ]);
                }else{
                    $this->curso->image()->create([
                        'url' => $this->imagen
                    ]);
                }
            }
            

            $this->emit('alert','Registro actualizado con exito!');
        } catch (\Exception $e) {
            $this->emit('error',$e->getMessage());
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
}
