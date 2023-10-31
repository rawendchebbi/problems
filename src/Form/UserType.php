<?php

namespace App\Form;

use App\Entity\User; // Update the entity class to User
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType // Rename the form type to UserType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name') // Replace 'username' with 'name'
            ->add('surname')
            ->add('dateOfBirth', null, ['widget' => 'single_text']) // Handle dateOfBirth as a date input
            ->add('userStatus')
            ->add('gender');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class, // Update the data class to User
        ]);
    }
}
