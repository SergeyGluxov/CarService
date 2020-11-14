<?php
namespace App\Http\Controllers\Api\Lean\Lessons;


use App\Http\Controllers\Controller;
use App\Services\LessonService;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    protected $lesson;
    public function __construct(LessonService $lesson)
    {
        $this->lesson=$lesson;
    }

    public function index(Request $request)
    {
        return $this->lesson->all();
    }

    public function destroy($id)
    {
        return $this->lesson->destroy($id);
    }
}
