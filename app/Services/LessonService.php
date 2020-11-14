<?php

namespace App\Services;

use App\Repositories\LessonRepository;

class LessonService
{
    protected $lessonRepository;

    public function __construct(LessonRepository $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    public function all()
    {
        return $this->lessonRepository->all();
    }

    public function destroy($id)
    {
        return $this->lessonRepository->destroy($id);
    }
}
