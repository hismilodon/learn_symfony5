<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;

class CommentController extends AbstractController
{
  /**
   * @Route("/comments/{id<\d+>}/vote/{direction<up|down>}", methods="POST")
   */
  public function commentVote($id, $direction, LoggerInterface $logger)
  {
    // todo - use id to query the database

    // use real logic here to save this to the database
    if ($direction === 'up') {
      $logger->warning('Voting up!', [$id, $direction, $this]);
      $currentVoteCount = rand(7, 100);
    } else {
      $logger->warning('Voting down!', [$id, $direction, $this]);
      $currentVoteCount = rand(0, 5);
    }
    
    return $this->json(['votes' => $currentVoteCount]);
  }
}