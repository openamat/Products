<?php

namespace App\Repositories\Fare;

use App\Repositories\Fare\Fare;
use Illuminate\Support\Facades\Schema;

class FareRepository
{
    public function __construct(Fare $fare)
    {
        $this->model = $fare;
    }

    /**
     * Returns all fares
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->model->orderBy('created_at', 'desc')->get();
    }

    /**
     * Returns all paginated $MODEL_NAME_PLURAL$
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function paginated($paginate)
    {
        return $this->model->orderBy('created_at', 'desc')->paginate($paginate);
    }

    /**
     * Search Fare
     *
     * @param string $input
     *
     * @return Fare
     */
    public function search($input, $paginate)
    {
        $query = $this->model->orderBy('created_at', 'desc');

        $columns = Schema::getColumnListing('fares');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input.'%');
        };

        return $query->paginate($paginate);
    }

    /**
     * Stores Fare into database
     *
     * @param array $input
     *
     * @return Fare
     */
    public function create($input)
    {
        return $this->model->create($input);
    }

    /**
     * Find Fare by given id
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Fare
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Destroy Fare
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Fare
     */
    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }

    /**
     * Truncate all Fares
     *
     *
     * @return \Illuminate\Support\Collection|null|static|Fare
     */
    public function truncate()
    {
        return $this->model->truncate();
    }

    /**
     * Updates Fare in the database
     *
     * @param int $id
     * @param array $inputs
     *
     * @return Fare
     */
    public function update($id, $inputs)
    {
        $fare = $this->model->find($id);
        $fare->fill($inputs);
        $fare->save();

        return $fare;
    }
}
