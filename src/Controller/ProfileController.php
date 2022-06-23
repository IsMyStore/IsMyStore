<?php

namespace App\Controller;

use App\Form\AccountEditFormType;
use App\Form\ProfilePictureUploadFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route(path: '/user')]
class ProfileController extends AbstractController {

	#[Route(path: '/', name: 'app_user_profile')]
	public function profile(Request $request, Security $security): Response {
		$accountForm = $this->createForm(AccountEditFormType::class, $security->getUser());
		$accountForm->handleRequest($request);
		$avatarForm = $this->createForm(ProfilePictureUploadFormType::class);
		$avatarForm->handleRequest($request);

		if($avatarForm->isValid() & $avatarForm->isSubmitted()){
			// move avatar and
		}

		return $this->render('user/user.html.twig', [
			"accountEditionForm" => $accountForm->createView(),
			"profilePictureUploadForm" => $avatarForm->createView(),
			'current_page' => "profile"
		]);
	}

	#[Route(path: '/store', name: 'app_user_store')]
	public function store(): Response {
		return $this->render('user/billing.html.twig', [
			'current_page' => "store"
		]);
	}

	#[Route(path: '/billing', name: 'app_user_billing')]
	public function billing(): Response {
		return $this->render('user/billing.html.twig', [
			'current_page' => "billing"
		]);
	}

	#[Route(path: '/security', name: 'app_user_security')]
	public function security(): Response {
		return $this->render('user/security.html.twig', [
			'current_page' => "security"
		]);
	}

	#[Route(path: '/notifications', name: 'app_user_notifications')]
	public function notifications(): Response {
		return $this->render('user/notifications.html.twig', [
			'current_page' => "notifications"
		]);
	}
}