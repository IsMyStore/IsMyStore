<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\AppAuthenticator;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController {

	private EmailVerifier $emailVerifier;

	public function __construct(EmailVerifier $emailVerifier) {
		$this->emailVerifier = $emailVerifier;
	}

	#[Route('/register', name: 'app_register')]
	public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, AppAuthenticator $authenticator, EntityManagerInterface $entityManager): Response {
		$user = new User();
		$form = $this->createForm(RegistrationFormType::class, $user);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$user->setUsername($form->get('username')->getData());
			$user->setFirstName($form->get('firstName')->getData());
			$user->setLastName($form->get('lastName')->getData());
			$user->setLocation($form->get('location')->getData());

			// encode the plain password
			$user->setPassword(
				$userPasswordHasher->hashPassword(
					$user,
					$form->get('plainPassword')->getData()
				)
			);

			$entityManager->persist($user);
			$entityManager->flush();

			// generate a signed url and email it to the user
			$this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
				(new TemplatedEmail())
					->from(new Address('gaetanhuspro@gmail.com', 'Alex'))
					->to($user->getEmail())
					->subject('Please Confirm your Email')
					->htmlTemplate('mails/confirmation_email.html.twig')
			);
			// do anything else you need here, like send an email

			return $userAuthenticator->authenticateUser(
				$user,
				$authenticator,
				$request
			);
		}

		return $this->render('security/register.html.twig', [
			'registrationForm' => $form->createView(),
			"current_page" => "register",
		]);
	}

	#[Route('/verify/email', name: 'app_verify_email')]
	public function verifyUserEmail(Request $request, TranslatorInterface $translator): Response {
		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

		// validate email confirmation link, sets User::isVerified=true and persists
		try {
			$this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
		} catch (VerifyEmailExceptionInterface $exception) {
			$this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

			return $this->redirectToRoute('app_register');
		}

		$this->addFlash('success', 'Your email address has been verified.');

		return $this->redirectToRoute('app_user_profile');
	}
}
