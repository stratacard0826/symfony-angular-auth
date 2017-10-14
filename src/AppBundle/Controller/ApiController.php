<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends Controller
{
    /**
     * @Route("/api/email", name="apiGetEmail")
     * @Method("GET")
     */
    public function emailAction(Request $request)
    {
        $userRepo = $this->getDoctrine()->getRepository('AppBundle:User');
        $current_user = $this->get('security.token_storage')
            ->getToken()
            ->getUser();
            
        $response = new JsonResponse(array("email" => $current_user->getEmail()));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }
    
    /**
     * @Route("/api/email", name="apiUpdateEmail")
     * @Method("POST")
     */
    public function updateEmailAction(Request $request)
    {
        
        $content = $request->getContent();
//        $params = $content
        $params = json_decode($content, true);
        $email = $params['email'];
        
        $userRepo = $this->getDoctrine()->getRepository('AppBundle:User');
        $current_user = $this->get('security.token_storage')
            ->getToken()
            ->getUser();
        $current_user->setEmail($email);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($current_user);
        $em->flush();
            
        $response = new JsonResponse(array("email" => $current_user->getEmail()));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }
    
}
