<?php

namespace App\Controller;

use App\Entity\TaskModel;
use App\Form\TaskModelType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    private $entityManager;
    private $logger;

    public function __construct(EntityManagerInterface $entityManager, LoggerInterface $logger)
    {
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    /**
     * @Route("/task/create", name="task_create", methods={"POST"})
     */
    public function create()
    {
        return $this->render('task/create.html.twig');
    }

    /**
     * @Route("/task/create/new", name="task_create_new", methods={"POST"})
     */
    public function createTask(Request $request)
    {
        $task = new TaskModel(40, $request->request->get('title'), $request->request->get('tags'), $request->request->get('duedate'), $request->request->get('notes'), $request->request->get('status'));

        $task->setTitle($request->request->get('title'));
        $task->setTags($request->request->get('tags'));
        $task->setDuedate($request->request->get('duedate'));
        $task->setNotes($request->request->get('notes'));
        $task->setStatus($request->request->get('status'));

        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/task/{id}", name="task")
     */
    public function view($id, TaskRepository $taskRepository): Response
    {
        $task = $taskRepository->findById($id);

        return $this->render('task/view.html.twig', [
            'task' => $task,
        ]);
    }

    /**
     * @Route("/task/edit/{id}", name="task")
     */
    public function edit($id, TaskRepository $taskRepository): Response
    {
        $task = $taskRepository->findById($id);

        return $this->json($task);
    }

    /**
     * @Route("/task/update/{id}", name="task_update")
     */
    public function update(Request $request, TaskRepository $taskRepository, $id = null)
    {
        $task = $taskRepository->find($id);

        $task->setTitle($request->request->get('title'));
        $task->setTags($request->request->get('tags'));
        $task->setDuedate($request->request->get('duedate'));
        $task->setNotes($request->request->get('notes'));
        $task->setStatus($request->request->get('status'));

        $this->entityManager->persist($task);
        $this->entityManager->flush($task);

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/task/delete/{id}", name="task_delete", methods={"DELETE"})
     */
    public function delete(Request $request, $id, TaskRepository $taskRepository)
    {

        $task = $taskRepository->find($id);

        $this->logger->info(gettype($task));

        $this->entityManager->remove($task);
        $this->entityManager->flush();

        return $this->redirectToRoute('homepage');
    }
}
?>