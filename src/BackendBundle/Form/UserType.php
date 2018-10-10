<?php

namespace BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Name',
                'attr' => array(
                    'required' => true
                )
            ))
            ->add('lastName', TextType::class, array(
                'label' => 'Last Name',
                'attr' => array(
                    'required' => true
                )
            ))
            ->add('nickname', TextType::class, array(
                'label' => 'Nick Name',
                'attr' => array(
                    'required' => true
                )
            ))
            ->add('email', EmailType::class, array(
                'label' => 'Email',
                'attr' => array(
                    'required' => true
                )
            ))
            ->add('password', PasswordType::class, array(
                'label' => 'Password',
                'attr' => array(
                    'required' => true
                )
            ))
            ->add('role', ChoiceType::class, array(
                'label' => 'Role',
                'choices' => array(
                    'User' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN'
                ),
                'attr' => array(
                    'required' => true
                )
            ))
            ->add('status', ChoiceType::class, array(
                'label' => 'Status',
                'choices' => array(
                    'Active' => 0,
                    'Inactive' => 1
                ),
                'attr' => array(
                    'required' => true
                )
            ))->add('submit', SubmitType::class, array(
                'label' => 'Submit'
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backendbundle_user';
    }


}
