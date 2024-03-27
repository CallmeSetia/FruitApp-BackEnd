<?php

namespace App\Repository\UserRepository;

interface UserRepositoryInterface
{
    public function get($request);
    public function create($request);
    public function update($request);
    public function delete($request);
}
