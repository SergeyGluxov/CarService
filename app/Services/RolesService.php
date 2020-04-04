<?php
namespace App\Services;

use App\Repositories\RolesRepository;
use Illuminate\Http\Request;

class RolesService
{
    protected $rolesRepository;
    public function __construct(RolesRepository $rolesRepository)
    {
        $this->rolesRepository=$rolesRepository;
    }

    public function all()
    {
        return $this->rolesRepository->all();
    }
    public function store(Request $request)
    {
        return $this->rolesRepository->store($request);
    }
}
