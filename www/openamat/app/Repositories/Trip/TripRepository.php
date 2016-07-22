<?php

namespace App\Repositories\Trip;

use App\Repositories\Trip\Trip;
use Illuminate\Support\Facades\Schema;

class TripRepository
{
    public function __construct(Trip $trip)
    {
        $this->model = $trip;
    }

    /**
     * Returns all trips
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
     * Search Trip
     *
     * @param string $input
     *
     * @return Trip
     */
    public function search($input, $paginate)
    {
        $query = $this->model->orderBy('created_at', 'desc');

        $columns = Schema::getColumnListing('trips');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input.'%');
        };

        return $query->paginate($paginate);
    }

    /**
     * Stores Trip into database
     *
     * @param array $input
     *
     * @return Trip
     */
    public function create($input)
    {
        return $this->model->create($input);
    }

    /**
     * Find Trip by given id
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Trip
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Destroy Trip
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Trip
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
     * Updates Trip in the database
     *
     * @param int $id
     * @param array $inputs
     *
     * @return Trip
     */
    public function update($id, $inputs)
    {
        $trip = $this->model->find($id);
        $trip->fill($inputs);
        $trip->save();

        return $trip;
    }
}
