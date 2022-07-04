<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/tableaubord")
 */
class SuperAdminController extends AbstractController
{
    /**
     * @Route("/", name="tb_index")
     */
 public function dashBoard()
 {
     return $this->render('base_admin.html.twig');
 }
}