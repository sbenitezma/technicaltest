<?php

namespace Kodify\BlogBundle\Controller;

use Kodify\BlogBundle\Entity\Author;
use Kodify\BlogBundle\Form\Type\AuthorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AuthorsController
 * @package Kodify\BlogBundle\Controller
 */
class AuthorsController extends Controller
{
    /**
     * Show 5 authors where 5 is the limit defined in AuthorRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $authors = $this->getDoctrine()->getRepository('KodifyBlogBundle:Author')->latest();

        return $this->render('KodifyBlogBundle::Author/list.html.twig', array('authors' => $authors));
    }
}
