<?php

namespace Jse\ImageCropBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ImageCropController extends Controller
{
    public function indexAction()
    {
        return $this->render('JseImageCropBundle:ImageCrop:index.html.twig');
    }

    public function saveAction(Request $request)
    {
        $container = $this->get('service_container');
        $upload_dir = $container->getParameter('upload_dir');
        $upload_path = $this->get('kernel')->getRootDir().'/../web/'.$upload_dir.'/';
        $uploadImages = $this->base64ToImage($request->get('image'), $upload_path.$request->get('image_name'));

        $response = new Response(json_encode(array('saved' => $uploadImages)));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    protected function base64ToImage($base64_string, $output_file)
    {
        $ifp = fopen($output_file, "wb");

        $data = explode(',', $base64_string);

        fwrite($ifp, base64_decode($data[1]));
        fclose($ifp);

        $saved = false;
        if(file_exists($output_file)){
            $saved = true;
        }

        return $saved;
    }

    public function imageCropPopUpAction()
    {
        $engine = $this->get('templating');

        $imageCrop = $engine->render('JseImageCropBundle:ImageCrop:image_crop.html.twig');

        $response = new Response($imageCrop);
        $response->headers->set('Content-Type', 'text/plain');

        return $response;
    }
}
