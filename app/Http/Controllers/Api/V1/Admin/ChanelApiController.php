<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChanelRequest;
use App\Http\Requests\UpdateChanelRequest;
use App\Http\Resources\Admin\ChanelResource;
use App\Models\Chanel;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChanelApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('chanel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ChanelResource(Chanel::with(['user'])->advancedFilter());
    }

    public function store(StoreChanelRequest $request)
    {
        $chanel = Chanel::create($request->validated());

        return (new ChanelResource($chanel))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function create(Chanel $chanel)
    {
        abort_if(Gate::denies('chanel_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'meta' => [
                'user' => User::get(['id', 'name']),
                'type' => Chanel::TYPE_SELECT,
            ],
        ]);
    }

    public function show(Chanel $chanel)
    {
        abort_if(Gate::denies('chanel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ChanelResource($chanel->load(['user']));
    }

    public function update(UpdateChanelRequest $request, Chanel $chanel)
    {
        $chanel->update($request->validated());

        return (new ChanelResource($chanel))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function edit(Chanel $chanel)
    {
        abort_if(Gate::denies('chanel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'data' => new ChanelResource($chanel->load(['user'])),
            'meta' => [
                'user' => User::get(['id', 'name']),
                'type' => Chanel::TYPE_SELECT,
            ],
        ]);
    }

    public function destroy(Chanel $chanel)
    {
        abort_if(Gate::denies('chanel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chanel->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
