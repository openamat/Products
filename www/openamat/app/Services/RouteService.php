<?php

namespace App\Services;

use App\Repositories\Route\RouteRepository;

class RouteService
{
    public function __construct(RouteRepository $routeRepository)
    {
        $this->repo = $routeRepository;
    }

    public function all()
    {
        return $this->repo->all();
    }

    public function paginated()
    {
        return $this->repo->paginated(env('paginate', 25));
    }

    public function search($input)
    {
        return $this->repo->search($input, env('paginate', 25));
    }

    public function create($input)
    {
        return $this->repo->create($input);
    }

    public function find($id)
    {
        return $this->repo->find($id);
    }

    public function update($id, $input)
    {
        return $this->repo->update($id, $input);
    }

    public function destroy($id)
    {
        return $this->repo->destroy($id);
    }

    public function truncate()
    {
        return $this->repo->truncate();
    }

}