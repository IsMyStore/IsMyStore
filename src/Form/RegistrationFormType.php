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
        $checkIP = new CheckIP($_SERVER['REMOTE_ADDR']);
        // FIX: Return REMOTE_ADDR ::1 (for xampp)
        // In: apache2/httpd.conf, replace 80 in Listen by 127.0.0.1:80

		$builder
			->add("username", TextType::class, [
				'label' => false,
				'required' => true,
				'attr' => [
					'placeholder' => "Username"
				]
			])
			->add("firstName", TextType::class, [
				'label' => false,
				'required' => true,
				'attr' => [
					'placeholder' => 'John'
				]
			])
			->add("lastName", TextType::class, [
				'label' => false,
				'required' => true,
				'attr' => [
					'placeholder' => 'Doe'
				]
			])
			->add('email', EmailType::class, [
				'label' => false,
				'required' => true,
				'attr' => [
					'placeholder' => 'Email',
				],
			])
			->add('location', CountryType::class, [
				'label' => false,
				'required' => true,
				'attr' => [
					'placeholder' => 'Country',
				],
				'data' => $checkIP->getCountryCode(),
			])
			->add('plainPassword', PasswordType::class, [
				'label' => false,
				'mapped' => false,
				'required' => true,
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
