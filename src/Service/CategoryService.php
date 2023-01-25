<?php
namespace App\Service;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;

class CategoryService
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getActiveCategoriesByPriority(int $priority): array
    {
        return $this->categoryRepository->findBy(
            [
                "status" => Category::STATUS_ACTIVE,
                "priority" => Category::MAX_PRIORITY
            ]
        );
    }

    public function getCategoriesForChoices(): array
    {
        $categoriesChoices = [];
        /** @var Category $categories */
        $categories = $this->categoryRepository->findBy(['status' => Category::STATUS_ACTIVE, 'priority' => Category::MAX_PRIORITY]);

        foreach ($categories as $category) {
            $categoriesChoices[$category->getName()] = $category->getId();
        }

        return $categoriesChoices;
    }
}