<?php
namespace App\Services;
use App\Repositories\Repository;

abstract class Service{
    protected $repository;

    public function __construct(Repository $repository){
        $this->repository=$repository;
    }
    public function getAll(){
        return $this->repository->getAll();
    }

    public function getById($id){
        return $this->repository->getById($id);
    }

    public function create(array $data){
        return $this->repository->create($data);
    }

    public function update($id, array $data){
        return $this->repository->update($id, $data);
    }

    public function delete($id){
        $this->repository->delete($id);
    }
}

 ?>
