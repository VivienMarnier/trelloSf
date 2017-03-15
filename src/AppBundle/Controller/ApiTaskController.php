<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class ApiCategoryController
 * @package AppBundle\Controller
 * @Rest\Route(path="/api/tasks")
 */
class ApiTaskController extends Controller
{
    /**
     * @Rest\View
     * @Rest\Get("/")
     * @ApiDoc(
     *  section="Tasks",
     *  description="Returns a collection of Task object",
     *  filters={
     *  {"name"="a-filter", "dataType"="integer"},
     *  {"name"="another-filter", "dataType"="string", "pattern"="(foo|bar) ASC|DESC"}
     *  }
     * )
     */
    public function getTasksAction()
    {
        //add paramFetcher QueryParam ....
        return $this->getTaskManager()->getTasks();
    }
    /**
     * @Rest\View
     * @Rest\Get("/{id}")
     * @ApiDoc(
     *     section="Tasks",
     *     description="Return a Task object",
     *     parameters={
     *       {"name"="id", "dataType"="integer", "required"=true, "description"="task id"}
     *    }
     * )
     */
    public function getTaskAction(Task $task)
    {
        return $task;
    }
    /**
     * @Rest\Post("/")
     * @Rest\View(statusCode=201)
     * @ApiDoc(
     *     section="Tasks",
     *     description="Create a new Task object",
     *     input="AppBundle\Form\TaskType",
     *     output="AppBundle\Entity\Task",
 *         statusCodes={
     *     201="Successful",
     *     400="Validation errors"
     *   },
     * )
     */
    public function postTaskAction(Request $request)
    {
        $form = $this->get('form.factory')->createNamed('',TaskType::class,$this->getTaskManager()->create(),['csrf_protection' => false]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $this->getTaskManager()->save($form->getData());
            return $form->getData();
        }
        return new View($form->getErrors(),Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param $slug
     * @param $id
     *  @Rest\View
     * @Rest\Put("/{id}")
     * @Rest\View(statusCode=201)
     * @ApiDoc(
     *     section="Tasks",
     *     description="Update a Task object",
     *     input="AppBundle\Form\TaskType",
     *     output="AppBundle\Entity\Task",
     *         statusCodes={
     *     201="Successful",
     *     400="Validation errors"
     *   },
     *     parameters={
     *       {"name"="id", "dataType"="integer", "required"=true, "description"="task id"}
     *    }
 *     )
     */
    public function editTaskAction(Request $request)
    {
        $form = $this->get('form.factory')->createdName('',TaskType::class,$this->getTaskManager()->getTask($request->get('id')),['crsf_protection' => false]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $this->getTaskManager()->save($form->getData());
            return $form->getData();
        }
        return new View($form->getErrors(),Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param $id
     * @Rest\View(statusCode=200)
     * @Rest\Delete("/{id}")
     * @ApiDoc(
     *     section="Tasks",
     *     description="Remove a Task object",
     *      parameters={
     *       {"name"="id", "dataType"="integer", "required"=true, "description"="task id"}
     *    }
 *     )
     */
    public function removeTaskAction(Task $task)
    {
        $this->getTaskManager()->remove($task);
    }

    //Todo factoriser cette fonction dans un trait pour les controleurs ?
    private function getTaskManager()
    {
        return $this->get('app.task_manager');
    }
}
