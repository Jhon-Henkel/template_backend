<?php

namespace App\Infra\Policy;

use App\Models\User\User;

interface IPolicy
{
    public function create(User $user): bool;
    public function list(User $user): bool;
    public function get(User $user): bool;
    public function update(User $user): bool;
    public function delete(User $user): bool;
}
