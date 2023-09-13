<?php

namespace App\Observers;

use App\Models\Lesson;
use Illuminate\Support\Facades\Storage;

class LessonObserver
{
    public function updating(Lesson $lesson)
    {
        $url = $lesson->url;
        $platform_id = $lesson->platform_id;

        if ($platform_id == 1) {
            $url = trim($url); // Limpia los espacios en blanco al principio y al final de la URL

            $pattern = '/^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=))([\w-]{10,12})$/';
            if (preg_match($pattern, $url, $matches)) {
                $lesson->iframe = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $matches[1] . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            }
        } else {
            $pattern = '/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/';
            if (preg_match($pattern, $url, $matches)) {
                $lesson->iframe = '<iframe src="https://player.vimeo.com/video/' . $matches[2] . '" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
            }
        }
    }

    public function creating(Lesson $lesson)
    {
        $url = $lesson->url;
        $platform_id = $lesson->platform_id;

        if ($platform_id == 1) {
            $url = trim($url); // Limpia los espacios en blanco al principio y al final de la URL

            $pattern = '/^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=))([\w-]{10,12})/';
            if (preg_match($pattern, $url, $matches)) {
                $videoId = $matches[1];

                // Verificar si hay parámetros de consulta en la URL y los agregar al iframe si existen
                $query = parse_url($url, PHP_URL_QUERY);
                $queryPart = $query ? '?' . $query : '';

                $lesson->iframe = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $videoId . $queryPart . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            }
        } else {
            $pattern = '/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/';
            if (preg_match($pattern, $url, $matches)) {
                $lesson->iframe = '<iframe src="https://player.vimeo.com/video/' . $matches[2] . '" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
            }
        }
    }

    public function deleting(Lesson $lesson)
    {
        if ($lesson->resource) {
            Storage::delete('public/' . $lesson->resource->url);
            $lesson->resource->delete();
        }
    }
}
