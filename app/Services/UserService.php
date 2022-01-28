<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function all()
    {
        return $this->userRepository->all();
    }

    public function getWorkers()
    {
        return $this->userRepository->getWorkers();
    }

    public function getWorkersFree(Request $request)
    {
        return $this->userRepository->getWorkersFree($request);
    }

    public function find($id)
    {
        return $this->userRepository->find($id);
    }

    public function store(Request $request)
    {
        return $this->userRepository->store($request);
    }

    public function destroy($id)
    {
        return $this->userRepository->destroy($id);
    }

    public function myself(Request $request)
    {
        return $this->userRepository->myself($request);
    }
}
