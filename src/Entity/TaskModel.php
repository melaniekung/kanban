<?php

namespace App\Entity;

class TaskModel
{
    private $task;
    private $status;
    private $notes;
    private $tags;
    private $duedate;

    public function __construct(string $task, string $status, string $notes, array $tags, string $duedate)
    {
        $this->task = $task;
        $this->status = $status;
        $this->notes = $notes;
        $this->tags = $tags;
        $this->duedate = $duedate;
    }

    public function getTask(): string
    {
        return $this->task;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getNotes(): string
    {
        return $this->notes;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function getDuedate(): string
    {
        return $this->duedate;
    }
}
