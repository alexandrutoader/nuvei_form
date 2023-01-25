<?php


namespace App\Controller;

use App\Dto\UserRequestDto;
use App\Entity\Category;
use App\Entity\Hobby;
use App\Entity\User;
use App\Form\UserFormType;
use App\Repository\DepartmentRepository;
use App\Service\CategoryService;
use App\Service\DepartmentService;
use App\Service\HobbyService;
use App\Service\UserService;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    private UserPasswordHasherInterface $passwordEncoder;
    private UserService $userService;
    private DepartmentRepository $departmentRepository;

    public function __construct(
        UserPasswordHasherInterface $passwordEncoder,
        UserService $userService,
        DepartmentRepository $departmentRepository
    )
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->userService = $userService;
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * @Route("/user-add", name="user-add")
     */
    public function add(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $userFromDb = $this->userService->findUserByEmailAndName($data->getEmail(), $data->getUserName());

            if ($userFromDb !== null) {
                $form
                    ->get('email')
                    ->addError(new FormError('Email address is not unique!'));

                return $this->render('user.html.twig', [
                    'form' => $form->createView(),
                ]);
            }

            $user
                ->setUserName($data->getUserName())
                ->setCategories($data->getCategories())
                ->setHobbies($data->getHobbies())
                ->setDepartment($this->departmentRepository->findOneBy(['id' => $data->getDepartment()]))
                ->setEmail($data->getEmail())
                ->setCreated(new DateTime())
                ->setModified(new DateTime());


            $password = $this->passwordEncoder->hashPassword($user, $data->getPassword());
            $user->setPassword($password);

            $this->userService->save($user);

            return $this->render('user.html.twig', [
                'form' => $form->createView(),
                "userSaved" => true,
                "user" => $user
            ]);
        }
        return $this->render('user.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}