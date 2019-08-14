<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Gumlet\ImageResize;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class ImageController extends AbstractController
{

  private function log(string $msg) {
    $path = $this->getParameter('kernel.project_dir').'/public/logs/log.log';
    $log = new Logger('name');
    $log->pushHandler(new StreamHandler($path, Logger::INFO));

    $log->info($msg);
  }

  /**
   * @Route("/", name="show")
   */
  public function show()
  {

      return $this->render('index.html.twig');
  }

    /**
     * @Route("/resize", methods={"POST"}, name="resize")
     */
    public function resize(Request $request)
    {

        $this->log('----------------------Init Resizing----------------------');
        $height = intval($request->get('height')); //Wysokość
        $this->log('Set height to '.$height.'.');
        $width = intval($request->get('width')); //Szerokość
        $this->log('Set width to '.$width.'.');
        $file = $request->files->get('file');

        $path = $this->getParameter('kernel.project_dir').'/public/pictures';
        if($file == NULL) {
          $file = $path.'/default.jpg';
          $this->log('Selecting picture was null, default would be used.');
        }
        else {
          $file->move($path,'upload.jpg');
          $name = $file->getClientOriginalName();
          $file = $path.'/upload.jpg';
          $this->log('Selecting picture would be used. Upload done. Name of picture was '.$name.'.');
        }

        $img = new ImageResize($file);

        $img->resize($width, $height, true);
        $img->save($path.'/picture.jpg');
        $this->log('Used picture resized.');
        $this->log('Picture displayed.');

        return $this->render('index.html.twig',array('picture' => true));
    }
}
