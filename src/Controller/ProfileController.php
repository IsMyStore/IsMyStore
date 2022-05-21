<?php

namespace App\Controller;

use App\Form\AccountEditFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

#[Route(path: '/user')]
class ProfileController extends AbstractController {

	#[Route(path: '/', name: 'app_user_profile')]
	public function profile(Request $request, Security $security): Response {
		$form = $this->createForm(AccountEditFormType::class, $security->getUser());
		$form->handleRequest($request);

		if($form->isSubmitted() and $form->isValid()){
			dump("cc");
		}

		return $this->render('user/user.html.twig',[
			"accountEditionForm" => $form->createView(),
			'current_page' => "profile"
		]);
	}

	#[Route(path: '/store', name: 'app_user_store')]
	public function store(): Response {
		return $this->render('user/user.html.twig',[
			'current_page' => "store"
		]);
	}

	#[Route(path: '/billing', name: 'app_user_billing')]
	public function billing(): Response {
		return $this->render('user/user.html.twig',[
			'current_page' => "billing"
		]);
	}

}