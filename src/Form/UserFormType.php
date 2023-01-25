<?php


namespace App\Form;


use App\Entity\Department;
use App\Entity\User;
use App\Repository\DepartmentRepository;
use App\Service\CategoryService;
use App\Service\DepartmentService;
use App\Service\HobbyService;
use PharIo\Manifest\Email;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class UserFormType extends AbstractType
{
    private DepartmentService $departmentService;
    private CategoryService $categoryService;
    private HobbyService $hobbyService;

    public function __construct(
        DepartmentService $departmentService,
        CategoryService $categoryService,
        HobbyService $hobbyService
    )
    {
        $this->departmentService = $departmentService;
        $this->categoryService = $categoryService;
        $this->hobbyService = $hobbyService;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'userName',
                TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 6, 'max' => 50])
                ],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => [
                    'label' => 'Password',
                ],
                'second_options' => [
                    'label' => 'Confirm Password',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                    ]),
                    new Regex([
                        'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#\$%\^&\*\(\)=\-_,\.\?]).{8,}$/',
                        'message' => 'Your password should contain at least one upper letter, one lower letter and a special char (! @ # $ % ^ & * ( ) - =)'
                    ]),
                ],
            ])
            ->add(
                'email',
                EmailType::class, [])
            ->add('department', ChoiceType::class, [
                'choices' => $this->departmentService->getDepartmentsForChoices(),
            ])
            ->add(
                'categories',
                ChoiceType::class, [
                'choices' => $this->categoryService->getCategoriesForChoices(),
                'multiple' => true,
                'expanded' => true,
            ])
            ->add(
                'hobbies',
                ChoiceType::class, [
                'choices' => $this->hobbyService->getHobbiesForChoices(),
                'multiple' => true,
                'expanded' => true,
            ])
            ->add(
                'terms_conditions',
                CheckboxType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
                'mapped' => false,
                'label' => 'I accept the terms and conditions',
            ])
            ->add(
                'save',
                SubmitType::class, [
                'attr' => ['class' => 'save'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}