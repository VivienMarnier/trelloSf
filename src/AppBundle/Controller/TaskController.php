<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends Controller
{
    /**
     * @Route("/task/new/", name="app_task_new", methods={"GET","POST"})
     */
    public function newAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    private function getTaskManager()
    {
        return $this->get('app.task_manager');
    }
}
