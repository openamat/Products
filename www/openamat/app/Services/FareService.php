<?php

namespace App\Services;

use App\Repositories\Fare\FareRepository;

class FareService
{
    public function __construct(FareRepository $fareRepository)
    {
        $this->repo = $fareRepository;
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

}