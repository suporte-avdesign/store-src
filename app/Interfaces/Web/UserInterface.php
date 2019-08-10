<?php

namespace AVD\Interfaces\Web;

interface UserInterface
{
    /**
     * Interface model User
     *
     * @return \AVD\Repositories\Web\UserRepository
     */
    public function setId($id);
    public function setEmail($email);
    public function setToken($token);
    public function create($input);
    public function update($input, $page);
    public function access($access, $id);
    public function logout($id);
}