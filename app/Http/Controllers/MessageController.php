<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageStoreRequest;
use App\Models\Message;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index($id)
    {
        $messages = Message::where('topic_id', $id)->orderBy('created_at', 'asc')->simplePaginate(2);

        return view('message.index', [
            'title' => 'Сообщения в теме ' . Topic::find($id)->title,
            'topicId' => $id,
            'messages' => $messages,
        ]);
    }

    public function store(MessageStoreRequest $request)
    {
        Message::create([
            'text' => $request->text,
            'topic_id' => $request->topicId,
            'user_id' => Auth::user()->id,
        ]);

        $topic = Topic::find($request->topicId);
        $topic->updated_at = date('Y-m-d H.i.s', time());
        $topic->save();

        return redirect()->back();
    }

    public function edit($id)
    {
        $message = Message::find($id);

        return view('message.edit',[
            'title' => 'Редактировать сообщение',
            'message' => $message,
        ]);
    }

    public function update(MessageStoreRequest $request, $id)
    {
        $message = Message::find($id);

        $message->text = $request->text;
        $message->save();

        return redirect()->route('message.list', ['id' => $message->topic->id]);
    }

    public function destroy($id)
    {
        $message = Message::find($id);
        $message->delete();

        return redirect()->back();
    }
}
