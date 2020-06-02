<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodotaskRequest;
use App\Interfaces\TodotaskRepositoryInterface;
use Illuminate\Http\Request;

class TodotasksController extends Controller
{
    private $todotaskRepository;

    public function __construct(TodotaskRepositoryInterface $todotaskRepository)
    {
        $this->todotaskRepository = $todotaskRepository;
    }

    public function todotasks(Request $request) {
        return $this->todotaskRepository->get();
    }

    public function todotask(Request $request, int $id) {
        return $this->todotaskRepository->getById($id);
    }

    public function deleteTodotask(Request $request, int $id) {
        return $this->todotaskRepository->delete($id);
    }

    public function putTodotask(TodotaskRequest $request, int $id) {
        return $this->todotaskRepository->update($id, $request->post());
    }

    public function postTodotask(TodotaskRequest $request) {
        return $this->todotaskRepository->insert($request->post());
    }
}
