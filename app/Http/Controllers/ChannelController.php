<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;
use App\Http\Requests\Channels\UpdateChannelRequest;

class ChannelController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth'])->only('update');
    }

    public function show(Channel $channel)
    {
        $videos = $channel->videos()->paginate(1);
        return view('channels.show', compact('channel', 'videos'));
    }

    public function update(UpdateChannelRequest $request, Channel $channel)
    {
        if ($request->hasFile('image')) {
            $channel->clearMediaCollection('images');
            $channel->addMediaFromRequest('image')->toMediaCollection('images');
        }

        $channel->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->back();
    }
}
