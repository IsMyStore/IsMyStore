<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilePictureUploadFormType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options): void {
		$builder
			->add('avatar', FileType::class, [
				'label' => 'Choose a profile picture',
				'label_attr' => ['class' => 'btn btn-sm btn-primary'],
				'required' => true,
				'attr' => [
					'accept' => "image/png, image/jpeg",
					'class' => "input-file",
					'placeholder' => 'Upload your profile picture'
				]
			]);
	}

	public function configureOptions(OptionsResolver $resolver): void {
		$resolver->setDefaults([
			'data_class' => null
		]);
	}
}
