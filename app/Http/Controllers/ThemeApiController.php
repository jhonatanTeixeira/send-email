<?php

namespace App\Http\Controllers;

use App\Http\Resources\ThemeResource;
use App\Theme;
use Illuminate\Http\Request;

class ThemeApiController extends Controller
{
    public function save(Request $request, $id = null)
    {
        $theme = $id > 0 ? Theme::findOrFail($id) : new Theme();

        $theme->name = $request->input('name');
        $theme->body = $request->input('body');

        if ($theme->save()) {
            return new ThemeResource($theme);
        }
    }

    public function list(Request $request)
    {
        $emails = Theme::paginate($request->query->get('limit', 30));

        return ThemeResource::collection($emails);
    }

    public function get($id)
    {
        $email = Theme::findOrFail($id);

        return new ThemeResource($email);
    }
}
