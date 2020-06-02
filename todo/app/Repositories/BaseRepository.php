<?php


namespace App\Repositories;


use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var Model $model
     */
    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    /**
     * Returns a query builder to get the full dataset
     * @param null $offset
     * @param null $limit
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function get($offset = null, $limit = null) {
        $query = $this->model::query();
        if (!is_null($offset)) {
            $query->offset($offset);
        }
        if (!is_null($limit)) {
            $query->limit($limit);
        }
        return $query;
    }

    /**
     * Returns one model by id
     * @param $id
     * @return mixed
     */
    public function getById($id) {
        $model = $this->model::find($id);
        if (is_null($model)) {
            abort(404);
        }
        else {
            return $model;
        }
    }

    /**
     * Inserts a new model
     * @param array $attributes
     * @return mixed
     */
    public function insert(array $attributes) {
        $model = $this->model::create($attributes);
        $model->refresh();
        return $model;
    }

    /**
     * Updates a model by id
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes) {
        $model = $this->getById($id);
        $model->update($attributes);
        $model->refresh();
        return $model;
    }

    /**
     * Deletes a model by id
     * @param $id
     * @return bool[]
     */
    public function delete($id) {
        $model = $this->getById($id);
        $model->delete();
        return ['success'=>true];
    }
}
