<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountEditFormType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options): void {
		$builder
			->add('username', TextType::class, [
				'disabled' => true,
				'label' => false,
				'attr' => [
					'placeholder' => 'Username'
				]
			])
			->add('firstName', TextType::class, [
				'disabled' => true,
				'label' => false,
				'attr' => [
					'placeholder' => 'John'
				]
			])
			->add('lastName', TextType::class, [
				'disabled' => true,
				'label' => false,
				'attr' => [
					'placeholder' => 'Doe'
				]
			])
			->add('location', CountryType::class, [
				'disabled' => true,
				'label' => false,
				'data' => 'FR',
			]);
	}

	public function configureOptions(OptionsResolver $resolver): void {
		$resolver->setDefaults([
			'data_class' => User::class,
		]);
	}
}
