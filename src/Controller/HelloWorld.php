<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HelloWorld extends AbstractController {
  /**
   * @Route("/hello_world", name="Hello World")
   */
  public function numberAction()
  {
    return new Response(
      '<html><body>Hello Symfony 4!</body></html>'
    );
  }
}