<?php

namespace Kodify\BlogBundle\Form\Handler;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CommentCreateHandler
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManager = $entityManagerInterface;
    }

    /**
     * Validate form and update database if needed
     *
     * @param Request $request
     * @param Form $form
     * @return bool
     */
    public function process(Request $request, Form $form)
    {
        if (!$request->isMethod('POST')) {
            return false;
        }

        $form->handleRequest($request);
        if (($form->isSubmitted()) && ($form->isValid())) {
            $comment = $form->getData();

            $this->entityManager->persist($comment);
            $this->entityManager->flush();

            $response = array(
                'status' => 'success',
                'content' => ''
            );
        }else{
            $response = array(
                'status' => 'error',
                'content' => ''
            );
        }
        return new JsonResponse( $response );
    }

}
