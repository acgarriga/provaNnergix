<?php

namespace WebCrawlerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($url="Sin nombre")
    {
        return $this->render('@WebCrawlerBundle/Resources/views/Default/index.html.twig',array('url'=>$url));
    }

    public function pageAction($url="")
    {
        return $this->render('@WebCrawlerBundle/Resources/views/Default/page.html.twig',array('url'=>$url));
        //return $this->redirectToRoute('web_crawler_homepage', array('url'=>$url));
        //return $this->redirect("http://www.google.es");
    }
}
