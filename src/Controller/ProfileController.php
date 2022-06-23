<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/user')]
class ProfileController extends AbstractController {

	#[Route(path: '/', name: 'app_user_profile')]
	public function profile(): Response {
		return $this->render('user/user.html.twig', [
			'current_page' => "store"
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