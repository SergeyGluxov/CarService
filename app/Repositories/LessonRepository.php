<?php

namespace App\Repositories;

use App\Http\Resources\LessonResource;
use App\Channel;

class LessonRepository
{
    protected $section;

    public function __construct(Channel $section)
    {
        $this->section = $section;
    }

    public function all()
    {
        LessonResource::withoutWrapping();
        return LessonResource::collection(Channel::all());
    }


    public function destroy($id)
    {
        $lessonDestroy = Channel::findOrFail($id);
        if ($lessonDestroy->delete())
            return response('Урок удален!', 200);
    }
}
