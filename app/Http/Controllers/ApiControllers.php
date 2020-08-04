<?php


namespace App\Http\Controllers;


use App\Traits\ApiResponse;
use Illuminate\Http\Request;

abstract class ApiControllers
{
    use ApiResponse;

    protected $model;

    /**
     * Get all object.
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $limit = (int) $request->get('limit', 100);
        $offset = (int) $request->get('offset', 0);

        $models = $this->model->limit($limit)->offset($offset)->get();

        return $this->sendResponse($models, 'OK', 200);
    }

    /**
     * Get object by Id.
     *
     * @param int $objectId
     * @return mixed
     */
    public function show(int $objectId)
    {
        return $this->model->get();
    }

    /**
     * Save the new object.
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $data = $request->validated();

        $this->model->fill($data)->push();

        return $this->sendResponse(null, 'Created', 201);
    }

    /**
     * Update the object by Id.
     *
     * @param Request $request
     * @param int $objectId
     * @return mixed
     */
    public function update(Request $request, int $objectId)
    {
        $object = $this->model->find($objectId);

        if (!$object) {
            return $this->sendError('Not found', 404);
        }

        $data = $request->validated();

        $this->model->fill($data)->push();

        return $this->sendResponse(null, 'Updated', 204);
    }


    /**
     * Remove object by Id.
     *
     * @param int $objectId
     * @return mixed
     */
    public function destroy(int $objectId)
    {
        $object = $this->model->find($objectId);

        if(!$object) {
            return $this->sendError('Not Found', 404);
        }

        $object->delete();

        return $this->sendResponse(null, 'Deleted', 204);
    }
}
