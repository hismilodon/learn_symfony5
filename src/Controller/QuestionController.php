<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use App\Service\MarkdownHelper;
use Psr\Log\LoggerInterface;

class QuestionController extends AbstractController
{
  private $logger;
  private $isDebug;

  public function __construct(LoggerInterface $logger, bool $isDebug)
  {
    $this->logger = $logger;
    $this->isDebug = $isDebug;
  }

  /**
   * @Route("/", name="app_homepage")
   */
  public function homepage(Environment $twigEnvironment)
  {
    return $this->render('question/homepage.html.twig');
  }

  /**
   * @Route("/questions/{slug}", name="app_question_show")
   */
  public function show($slug, MarkdownHelper $markdownHelper)
  {
    dump($this->getParameter('cache_adapter'));
    dump($this);
    if ($this->isDebug) {
      $this->logger->info('We are in debug mode!');
    }

    $answers = [
      'Make sure your cat is sitting `purrrfectly` still 🤣',
      'Honestly, I like furry shoes better than MY cat',
      'Maybe... try saying the spell backwards?',
    ];
    $questionText = 'I\'ve been turned into **a cat**, any thoughts on how to turn back? While I\'m **adorable**, I don\'t really care for cat food.';
    $parsedQuestionText = $markdownHelper->parse($questionText);

    dump($markdownHelper);

    return $this->render('question/show.html.twig', [
      'question' => ucwords(str_replace('-', ' ', $slug)),
      'questionText' => $parsedQuestionText,
      'answers' => $answers,
    ]);
  }
}
