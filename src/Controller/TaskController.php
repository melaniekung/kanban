<?php

namespace App\Controller;

use App\Entity\TaskModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends AbstractController
{
    public function index(): Response
    {
        $taskCard = new TaskModel(
            'Task 1',
            'Todo',
            'Notes... more notes...',
            ['Task', 'Tag'],
            '2023/02/28',
        );

        return $this->render('task/index.html.twig', [
            'task' => $taskCard,
        ]);
    }
}
