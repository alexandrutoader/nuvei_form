<?php


namespace App\Service;


use App\Entity\Department;
use App\Repository\DepartmentRepository;

class DepartmentService
{
    private DepartmentRepository $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function getDepartmentsForChoices(): array
    {
        $departmentsChoices = [];
        /** @var Department $departments */
        $departments = $this->departmentRepository->findAll();

        foreach ($departments as $department) {
            $departmentsChoices[$department->getName()] = $department->getId();
        }

        return $departmentsChoices;
    }
}