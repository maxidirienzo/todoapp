<?php


namespace App\Repositories;
use App\Interfaces\TodotaskRepositoryInterface;
use App\Models\Todotask;

class TodotaskRepository extends BaseRepository implements TodotaskRepositoryInterface
{
    public function __construct(Todotask $model) {
        $this->model = $model;
    }

    public function get($offset = null, $limit = null)
    {
        return parent::get($offset, $limit)->orderBy('created_at', 'DESC')->get();
    }
}
