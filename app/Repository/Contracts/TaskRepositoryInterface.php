<?php

namespace App\Repository\Contracts;

use App\Models\Task;
use phpDocumentor\Reflection\Types\Collection;

interface TaskRepositoryInterface
{
    public function all();
    public function find($id): ?Task;
    public function add(array $data): Task;
    public function update($id,array $data): ?Task;
    public function delete($id): bool;
}
