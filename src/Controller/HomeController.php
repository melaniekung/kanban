<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TaskRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(TaskRepository $taskRepository): Response
    {
        $todo = $taskRepository->findByStatus('todo');
        $progress = $taskRepository->findByStatus('progress');
        $blocked = $taskRepository->findByStatus('blocked');
        $done = $taskRepository->findByStatus('done');

        return $this->render('home/index.html.twig', [
            'todo' => $todo,
            'progress' => $progress,
            'blocked' => $blocked,
            'done' => $done,
        ]);
    }
}
?>