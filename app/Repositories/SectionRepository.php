<?php

namespace App\Repositories;

use App\Http\Resources\SectionResource;
use App\Section;

class SectionRepository
{
    protected $section;

    public function __construct(Section $section)
    {
        $this->section = $section;
    }

    public function all()
    {
        SectionResource::withoutWrapping();
        return SectionResource::collection(Section::all());
    }


    public function destroy($id)
    {
        $sectionDestroy = Section::findOrFail($id);
        if ($sectionDestroy->delete())
            return response('Секция удалена!', 200);
    }
}
