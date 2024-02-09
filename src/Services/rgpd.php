<?php

namespace App\Services;

use App\Repository\UserRepository;

class rgpd
{
  private $time;
  private $userRepository;

  public function __construct(
    UserRepository $userRepository,
  ) {
    $this->userRepository = $userRepository;
    $this->time = 'now -1 year';
  }

  public function deleteUser(): void {
    $users = $this->userRepository->findBy([], ['id' => 'DESC']);

    foreach ($users as $user) {
      if ($user->getRoles() == ['ROLE_USER']) {
        if ($user->getCreatedAt() < new \DateTime($this->time)) {
          $this->userRepository->removeUser($user);
        }
      }
    }
  }
}
