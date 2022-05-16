<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

	/**
	 * @Route("/", name="home")
	 */
	public function index() : Response {
		return $this->render('base/home.html.twig', [
			"current_page" => "default"
		]);
	}

	/**
	 * @Route("/pricing", name="pricing")
	 */
	public function pricing() : Response {
		return $this->render('base/pricing.html.twig', [
			"current_page" => "pricing"
		]);
	}

	/**
	 * @Route("/contact", name="contact")
	 */
	public function contact() : Response {
		return $this->render('base/contact.html.twig', [
			"current_page" => "contact"
		]);
	}

	/**
	 * @Route("/blog", name="blog")
	 */
	public function blog() : Response {
		return $this->render('base/blog.html.twig', [
			"current_page" => "blog"
		]);
	}
}