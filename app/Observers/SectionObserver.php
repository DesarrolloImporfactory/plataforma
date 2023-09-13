<?php

namespace App\Observers;

use App\Models\Section;
use Illuminate\Support\Facades\Storage;

class SectionObserver
{
    public function deleting(Section $section){
        foreach ($section->lesson as $lesson) {
            if ($lesson->resource) {
                Storage::delete('public/' . $lesson->resource->url);
                $lesson->resource->delete();
            }
        }
    }
}
