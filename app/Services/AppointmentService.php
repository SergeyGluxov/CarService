<?php
namespace App\Services;

abstract class AppointmentService
{
    public $repository;

    public function all()
    {
        return $this->repository->all();
    }
}