<?php

namespace App\Services;

use App\Repositories\SectionRepository;

class SectionService
{
    protected $sectionRepository;

    public function __construct(SectionRepository $sectionRepository)
    {
        $this->sectionRepository = $sectionRepository;
    }

    public function all()
    {
        return $this->sectionRepository->all();
    }

    public function destroy($id)
    {
        return $this->sectionRepository->destroy($id);
    }
}
