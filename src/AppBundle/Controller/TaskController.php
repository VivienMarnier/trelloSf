<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\TaskType;

class TaskController extends Controller
{
    /**
     * @Route("/task/new/", name="app_task_new", methods={"GET","POST"})
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(TaskType::class, $this->getTaskManager()->create()); // retourne un objet Form
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $this->getTaskManager()->save($form->getData());
            $this->addFlash('success', 'Votre Tâche a bien été crée !');
            return $this->redirectToRoute('homepage');
        }
        return $this->render(':task:new.html.twig', array('form' => $form->createView()));
    }
    /**
     * @Route("/task/{id}", name="app_task_view")
     */
    public function viewAction(Request $request)
    {
        $task = $this->getTaskManager()->getTask($request->get('id'));
        if (!$task instanceof Task)
        {
            throw $this->createNotFoundException(sprintf('La tâche d\'id : %s n\'existe pas !', $id));
        }
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $this->getTaskManager()->save($form->getData());
            $this->addFlash('success', 'Votre Tâche a bien été mise à jour !');
            return $this->redirectToRoute('homepage');
        }
        return $this->render(':task:view.html.twig', ['form' => $form->createView()]);
    }
    private function getTaskManager()
    {
        return $this->get('app.task_manager');
    }
}
