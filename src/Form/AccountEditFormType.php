<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountEditFormType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options): void {
		$builder
			->add('username', TextType::class, [
				'label' => false,
				'attr' => [
					'placeholder' => 'Username'
				]
			])
			->add('first_name', TextType::class, [
				'label' => false,
				'attr' => [
					'placeholder' => 'John'
				]
			])
			->add('last_name', TextType::class, [
				'label' => false,
				'attr' => [
					'placeholder' => 'Doe'
				]
			])
			->add('organization_name', TextType::class, [
				'label' => false,
				'required' => false,
				'attr' => [
					'placeholder' => 'Doe Entreprise'
				]
			])
			->add('location', TextType::class, [
				'label' => false,
				'required' => false,
				'attr' => [
					'placeholder' => 'Nevada'
				]
			])
			->add('email', EmailType::class, [
				'label' => false,
				'attr' => [
					'placeholder' => 'john@doe.com'
				]
			]);
	}

	public function configureOptions(OptionsResolver $resolver): void {
		$resolver->setDefaults([
			'data_class' => User::class,
		]);
	}
}
