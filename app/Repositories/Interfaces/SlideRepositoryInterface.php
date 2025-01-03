<?php

namespace App\Repositories\Interfaces;


/**
 * Interface SlideRepositoryInterface
 * @package App\Services\Interfaces
 */
interface SlideRepositoryInterface extends BaseRepositoryInterface
{
    public function findById(int $id, array $column = ['*'], array $relation = []);
    public function create(array $payload = []);
    public function update(int $id, array $payload = []);
    public function delete(int $id);
    public function forceDelete(int $id);
}
