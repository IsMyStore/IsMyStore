<?php

namespace App\Form;

use App\Entity\User;
use ismystore\checkip\CheckIP;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options): void {
		$checkIP = new CheckIP($_SERVER['REMOTE_ADDR']);;
		$builder
			->add("firstName",TextType::class,[
				'label' => false,
				'attr' => [
					'placeholder' => 'John'
				]
			])
			->add("lastName",TextType::class,[
				'label' => false,
				'attr' => [
					'placeholder' => 'Doe'
				]
			])
			->add('email', EmailType::class, [
				'label' => false,
				'attr' => [
					'placeholder' => 'Email',
				],
			])
			->add('location', CountryType::class, [
				'label' => false,
				'attr' => [
					'placeholder' => 'Country',
				],
				'data' => $checkIP->getCountryCode(),
			])
			->add('plainPassword', PasswordType::class, [
				'label' => false,
				'mapped' => false,
				'attr' => ['autocomplete' => 'new-password', 'placeholder' => 'Password'],
				'constraints' => [
					new NotBlank([
						'message' => 'Please enter a password',
					]),
					new Length([
						'min' => 6,
						'minMessage' => 'Your password should be at least {{ limit }} characters',
						'max' => 4096,
					]),
				],
			]);
	}

	public function configureOptions(OptionsResolver $resolver): void {
		$resolver->setDefaults([
			'data_class' => User::class,
		]);
	}
}
