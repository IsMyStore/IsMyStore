<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ProfilePictureUploadFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('avatar',FileType::class,[
				'label' => false,
				'required' => true,
				'constraints' => [
					new File([
						'maxSize' => '1024k',
						'mimeTypes' => [
							'image/jpeg',
							'image/png',
							'image/gif',
						],
						'mimeTypesMessage' => 'Please upload a valid image',
					])
				],
				'attr' => [
					'placeholder' => 'Upload your profile picture'
				]
			])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
			'data_class' => null
        ]);
    }
}
