<?php

namespace Kodify\BlogBundle\Controller;

use Kodify\BlogBundle\Entity\Comment;
use Kodify\BlogBundle\Entity\Post;
use Kodify\BlogBundle\Form\Handler\GeneralCreateHandler;
use Kodify\BlogBundle\Form\Type\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class CommentsController
 * @package Kodify\BlogBundle\Controller
 */
class CommentsController extends Controller
{
    /**
     * Function to create a new comment
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request, Post $post)
    {
        $newComment = new Comment();
        $newComment->setPost($post);
        $form = $this->createForm(
            new CommentType(),
            $newComment,
            [
                'action'           => $this->generateUrl('create_comment', ['id' => $post->getId()]),
                'method'           => 'POST',
                'post_transformer' => $this->get('kodify_blog.form.data_transformer.post_to_number'),
            ]
        );
        $parameters = [];

        /** @var GeneralCreateHandler $handler */
        $handler = $this->get('kodify.blog.create_comment');
        $response = $handler->process($request, $form);
        if ($response){
            $result = json_decode($response->getContent());
            $parameters['result'] = $result->status;
            return new JsonResponse( $result );
        }
        // the form element should be passed to the view after validate it to show errors
        $parameters['form'] = $form->createView();

        //if something goes wrong show the form again
        return $this->render('KodifyBlogBundle:Default:create.html.twig', $parameters);
    }
}
