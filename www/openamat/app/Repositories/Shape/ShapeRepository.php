<?php

namespace App\Repositories\Shape;

use App\Repositories\Shape\Shape;
use Illuminate\Support\Facades\Schema;

class ShapeRepository
{
    public function __construct(Shape $shape)
    {
        $this->model = $shape;
    }

    /**
     * Returns all shapes
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
     * Search Shape
     *
     * @param string $input
     *
     * @return Shape
     */
    public function search($input, $paginate)
    {
        $query = $this->model->orderBy('created_at', 'desc');

        $columns = Schema::getColumnListing('shapes');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input.'%');
        };

        return $query->paginate($paginate);
    }

    /**
     * Stores Shape into database
     *
     * @param array $input
     *
     * @return Shape
     */
    public function create($input)
    {
        return $this->model->create($input);
    }

    /**
     * Find Shape by given id
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Shape
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Destroy Shape
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Shape
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
     * Updates Shape in the database
     *
     * @param int $id
     * @param array $inputs
     *
     * @return Shape
     */
    public function update($id, $inputs)
    {
        $shape = $this->model->find($id);
        $shape->fill($inputs);
        $shape->save();

        return $shape;
    }
}
