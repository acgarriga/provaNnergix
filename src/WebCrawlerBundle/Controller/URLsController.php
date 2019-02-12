<?php

namespace WebCrawlerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use WebCrawlerBundle\Entity\URLs;
use WebCrawlerBundle\Form\URLsType;
use Symfony\Component\HttpFoundation\Request;

class URLsController extends Controller
{
    public function indexAction(Request $request)
    {
      $url = new URLs();
      $form = $this->createForm(URLsType::class,$url);
      //var_dump($request);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
          $historial_urls = array();
          $url = $form->getData();
          $historial_urls[] = $url->getUrl();
          URLsController::guardar($url);
          $profunditat = $form->get("profunditat")->getData();
          URLsController::buscar($url,$profunditat,$historial_urls);

          return $this->render('@WebCrawlerBundle/Resources/views/URLs/view.html.twig', array("urls"=>$historial_urls));
      }

      return $this->render('@WebCrawlerBundle/Resources/views/URLs/index.html.twig', array("formulari"=>$form->createView()));
    }

    public function guardar(URLs $url){
      $temp = new URLs;
      $temp->setUrl($url->getUrl());
      $temp->setHeaders($url->getHeaders());
      $headers_temp = "";
      $headers_url = URLsController::getHeadersUrl($url->getUrl());
      foreach ($url->getHeaders() as $key) {
        if (array_key_exists($key, $headers_url)) {
            $headers_temp.= $key . ":" . $headers_url[$key] . '|';
        }
      }
      $temp->setHeaders($headers_temp);
      $manager = $this->getDoctrine()->getManager();
      $manager->persist($temp);
      $manager->flush();
    }

    public function getHeadersUrl(string $url){
      file_get_contents($url);
      $head = array();
      foreach( $http_response_header as $key=>$value )
      {
          $h = explode( ':', $value, 2 );
          if( isset( $h[1] ) )
              $head[ trim($h[0]) ] = trim( $h[1] );
          else
          {
              $head[] = $value;
              if( preg_match( "#HTTP/[0-9\.]+\s+([0-9]+)#",$value, $out ) )
                  $head['response_code'] = intval($out[1]);
          }
      }
      return $head;
    }

    public function buscar(URLs $url, int $profunditat, &$historial_urls){
      $urls = array();
      $urls[] = $url->getUrl();
      for ($i=1; $i<=$profunditat; $i++) {
        $temp = array();
        foreach ($urls as $u) {
          $html = file_get_html($u);
          foreach($html->find('a') as $element){
            if (!in_array($element->href,$historial_urls) && preg_match ('~^http~', $element->href)){
              $historial_urls[]=$element->href;
              $temp[]=$element->href;
              $t = new URLs;
              URLsController::guardar($t->setUrl($element->href)->setHeaders($url->getHeaders()));
            }
          }
        }
        $urls = $temp;
      }
    }

}
