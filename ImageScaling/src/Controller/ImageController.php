<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ImageController extends AbstractController
{

  /**
   * @Route("/", name="show")
   */
  public function show(Request $requrest)
  {

      // $this->
      // return $this->json([
      //     'message' => 'Welcome to your new controller!',
      //     'path' => 'src/Controller/ImageController.php',
      // ]);

      return $this->render('index.html.twig');
  }

    /**
     * @Route("/resize", methods={"POST"}, name="resize")
     */
    public function resize(Request $requrest)
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ImageController.php',
        ]);
    }
}
