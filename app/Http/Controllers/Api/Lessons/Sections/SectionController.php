<?php
namespace App\Http\Controllers\Api\Lessons\Sections;


use App\Http\Controllers\Controller;
use App\Services\SectionService;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    protected $section;
    public function __construct(SectionService $section)
    {
        $this->section=$section;
    }

    public function index(Request $request)
    {
        return $this->section->all();
    }

    public function destroy($id)
    {
        return $this->section->destroy($id);
    }
}
