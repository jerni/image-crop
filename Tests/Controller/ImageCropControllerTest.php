<?php

namespace Jse\ImageCropBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageCropControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient(array(),  array(
            'HTTP_HOST' => 'dev.cms_sandbox_tester.com'
        ));

        $client->request('POST', '/image-crop/save',array('image' => file_get_contents(__DIR__.'/image/base64img.txt'), 'image_name' => 'test_image.jpg'));

        $this->assertEquals(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
}
