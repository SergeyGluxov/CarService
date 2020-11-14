<?php

namespace App\Repositories;

use App\Http\Resources\LessonResource;
use App\Lesson;

class LessonRepository
{
    protected $section;

    public function __construct(Lesson $section)
    {
        $this->section = $section;
    }

    public function all()
    {
        LessonResource::withoutWrapping();
        return LessonResource::collection(Lesson::all());
    }


    public function destroy($id)
    {
        $lessonDestroy = Lesson::findOrFail($id);
        if ($lessonDestroy->delete())
            return response('Урок удален!', 200);
    }
}
