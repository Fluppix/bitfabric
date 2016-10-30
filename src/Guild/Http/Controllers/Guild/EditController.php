<?php

namespace Bitaac\Guild\Http\Controllers\Guild;

use App\Http\Controllers\Controller;
use Bitaac\Guild\Http\Requests\Guild\EditRequest;

class EditController extends Controller
{
    /**
     * Show the edit guild form to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function form($guild)
    {
        return view('bitaac::guilds.guild.edit')->with(compact('guild'));
    }

    /**
     * Process the edition.
     *
     * @return \Illuminate\Http\Response
     */
    public function post(EditRequest $request, $guild)
    {   
        if ($request->has('description')) {
            $guild->bitaac->description = $request->get('description');
            $guild->bitaac->save();
        }

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');

            $guild->bitaac->logo = public_path("guild_avatars/{$guild->id}.gif");

            $file->move(public_path('guild_avatars'), "{$guild->id}.gif");

            $guild->bitaac->save();
        }
    }

    /**
     * Delete current logo.
     *
     * @return \Illuminate\Http\Response
     */
    public function deletelogo($guild)
    {
        app('files')->delete($guild->bitaac->logo);

        $guild->bitaac->logo = null;

        $guild->bitaac->save();

        return redirect("{$guild->link()}/edit");
    }
}
