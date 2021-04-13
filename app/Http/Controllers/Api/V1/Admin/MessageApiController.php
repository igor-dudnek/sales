<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Http\Resources\Admin\MessageResource;
use App\Models\Chanel;
use App\Models\Message;
use App\Models\Tag;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MessageApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('message_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MessageResource(Message::with(['chanel', 'tag'])->advancedFilter());
    }

    public function store(StoreMessageRequest $request)
    {
        $message = Message::create($request->validated());
        $message->tag()->sync($request->input('tag.*.id', []));

        return (new MessageResource($message))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function create(Message $message)
    {
        abort_if(Gate::denies('message_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'meta' => [
                'chanel' => Chanel::get(['id', 'chanelurl']),
                'tag'    => Tag::get(['id', 'tag']),
            ],
        ]);
    }

    public function show(Message $message)
    {
        abort_if(Gate::denies('message_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MessageResource($message->load(['chanel', 'tag']));
    }

    public function update(UpdateMessageRequest $request, Message $message)
    {
        $message->update($request->validated());
        $message->tag()->sync($request->input('tag.*.id', []));

        return (new MessageResource($message))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function edit(Message $message)
    {
        abort_if(Gate::denies('message_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'data' => new MessageResource($message->load(['chanel', 'tag'])),
            'meta' => [
                'chanel' => Chanel::get(['id', 'chanelurl']),
                'tag'    => Tag::get(['id', 'tag']),
            ],
        ]);
    }

    public function destroy(Message $message)
    {
        abort_if(Gate::denies('message_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $message->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
