<?php


namespace App\Controllers;


use App\Core\Controller;
use App\Helpers\Debug;
use App\Models\Task;


class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::all();
        $this->render('index', ['name' => 'Abdulaziz']);
    }

    public function list()
    {
        $this->render('list', ['title' => 'This is list page']);
    }

}