<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface {

	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column(type: 'integer')]
	private $id;

	#[ORM\Column(type: 'string', length: 180, unique: true, nullable: false)]
	private $email;

	#[ORM\Column(type: 'json', nullable: false)]
	private $roles = [];

	#[ORM\Column(type: 'string', nullable: false)]
	private $password;

	#[ORM\Column(type: 'string', length: 255, nullable: false)]
	private $first_name;

	#[ORM\Column(type: 'string', length: 255, nullable: false)]
	private $last_name;

	#[ORM\Column(type: 'string', length: 255, nullable: false)]
	private $location;

	#[ORM\Column(type: 'string', length: 255, nullable: true)]
	private $phone_number;

	#[ORM\Column(type: 'string', length: 255, unique: true, nullable: false)]
	private $username;

	#[ORM\Column(type: 'boolean')]
	private $isVerified = false;

	public function getEmail(): ?string {
		return $this->email;
	}

	public function setEmail(string $email): self {
		$this->email = $email;

		return $this;
	}

	/**
	 * A visual identifier that represents this user.
	 *
	 * @see UserInterface
	 */
	public function getUserIdentifier(): string {
		return (string)$this->email;
	}

	/**
	 * @see UserInterface
	 */
	public function getRoles(): array {
		$roles = $this->roles;
		// guarantee every user at least has ROLE_USER
		$roles[] = 'ROLE_USER';

		return array_unique($roles);
	}

	public function setRoles(array $roles): self {
		$this->roles = $roles;

		return $this;
	}

	/**
	 * @see PasswordAuthenticatedUserInterface
	 */
	public function getPassword(): string {
		return $this->password;
	}

	public function setPassword(string $password): self {
		$this->password = $password;

		return $this;
	}

	/**
	 * @see UserInterface
	 */
	public function eraseCredentials() {
		// If you store any temporary, sensitive data on the user, clear it here
		// $this->plainPassword = null;
	}

	public function getFirstName(): ?string {
		return $this->first_name;
	}

	public function setFirstName(string $first_name): self {
		$this->first_name = $first_name;

		return $this;
	}

	public function getLastName(): ?string {
		return $this->last_name;
	}

	public function setLastName(string $last_name): self {
		$this->last_name = $last_name;

		return $this;
	}

	public function getLocation(): ?string {
		return $this->location;
	}

	public function setLocation(string $location): self {
		$this->location = $location;

		return $this;
	}

	public function getPhoneNumber(): ?string {
		return $this->phone_number;
	}

	public function setPhoneNumber(?string $phone_number): self {
		$this->phone_number = $phone_number;

		return $this;
	}

	public function getUsername(): ?string {
		return $this->username;
	}

	public function setUsername(string $username): self {
		$this->username = $username;

		return $this;
	}

	public function isVerified(): bool {
		return $this->isVerified;
	}

	public function setIsVerified(bool $isVerified): self {
		$this->isVerified = $isVerified;

		return $this;
	}

	public function getAvatar(): string {
		if (file_exists(__DIR__ . '../../../public/files/avatars/' . $this->getId() . '.jpg')) {
			return '/files/avatars/' . $this->getId() . '.jpg';
		} else {
			return '/files/avatars/default.jpg';
		}
	}

	public function getId(): ?int {
		return $this->id;
	}
}
