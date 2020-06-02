<?php

namespace App\Interfaces;

interface BaseRepositoryInterface
{
    public function get($offset = null, $limit = null);
    public function getById($id);
    public function insert(array $attributes);
    public function update($id, array $attributes);
    public function delete($id);
}
