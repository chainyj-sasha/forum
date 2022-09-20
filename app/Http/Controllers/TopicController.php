<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicStoreRequest;
use App\Models\Message;
use App\Models\Section;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function index($id)
    {
        $topics = Topic::where('section_id', $id)->orderBy('updated_at', 'desc')->simplePaginate(2);

        return view('topic.index', [
            'title' => 'Темы раздела ' . Section::find($id)->title,
            'sectionId' => $id,
            'topics' => $topics,
        ]);
    }

    public function store(TopicStoreRequest $request)
    {
        Topic::create([
            'title' => $request->title,
            'section_id' => $request->sectionId,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back();
    }

    public function edit($id)
    {
        $topic = Topic::find($id);

        return view('topic.edit', [
            'title' => 'Редактировать тему',
            'topic' => $topic,
        ]);
    }

    public function update(TopicStoreRequest $request, $id)
    {
        $topic = Topic::find($id);
        $topic->title = $request->title;
        $topic->save();

        $request->session()->flash('success', 'Сохранено успешно!');
        return redirect()->route('topic.list', ['id' => $topic->section->id]);
    }

    public function destroy($id)
    {
        $topic = Topic::find($id);
        $topic->delete();

        $messages = Message::where('topic_id', $id)->get();
        foreach ($messages as $message){
            $message->delete();
        }
        return redirect()->back();
    }
}
