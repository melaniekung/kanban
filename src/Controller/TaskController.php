<?php

namespace App\Controller;

use App\Form\TaskModelType;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
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
     * @Route("/task/update/{id}", name="task")
     */
    public function update(Request $request, $id, TaskRepository $taskRepository): Response
    {
        $task = $taskRepository->findById($id);

        if (!$task) {
            throw $this->createNotFoundException('Task not found');
        }

        $form = $this->createForm(TaskModelType::class, null, ['data_class' => TaskModelType::class]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->json(['success' => true]);
        }

        return $this->json(['success' => false]);
    }
}