<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Idea;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Workflow\Exception\LogicException;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="change_status")
     */
    public function indexAction(Request $request)
    {
        if(!$request->get('id'))
        {
            return $this->redirectToRoute('admin', ['entity' => 'Idea']);
        }
        $repository = $this->getDoctrine()->getRepository('AppBundle:Idea');

        $idea = $repository->find($request->get('id'));

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'idea' => $idea
        ]);
    }

    /**
     * @Route("/handle/{id}/{transition}", name="handle")
     */
    public function handleAction($id, $transition)
    {
        $response = new Response();

        $workflow = $this->get('state_machine.idea');

        $repo = $this->getDoctrine()->getRepository('AppBundle:Idea');
        $idea = $repo->find($id);

        if (!$idea)
        {
            throw new NotFoundHttpException;
        }

        try {
            $workflow->apply($idea, $transition);

            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', sprintf('Transitioned %s through %s', $idea->getTitle(), $transition));
        } catch (LogicException $e) {
            $this->addFlash('danger', $e->getMessage());
        }

        return $this->redirectToRoute('change_status', ['id' => $id]);
    }
}
