<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\Post;

class PostController extends Controller
{
    public function getAllPost()
    {
        try {
            $data = Post::all();
            return response((array("code" => 200, "status" => "success", "data" => $data)), 200);
        } catch (Exception $err) {
            return response()->json(
                array(
                    "code" => 500, "status" => "error", "message" => $err->getMessage()
                )
            );
        }
    }

    public function getPost($id)
    {
        try {
            $data = Post::find($id);
            return response()->json((array("code" => 200, "status" => "success", "data" => $data)));
        } catch (Exception $err) {
            return response()->json(
                array(
                    "code" => 500, "status" => "error", "message" => $err->getMessage()
                )
            );
        }
    }

    public function postPost(Request $request)
    {
        try {
            $title = $request->get("title");
            $description = $request->get("description");
            $data = Post::create([
                'title' => $title,
                'description' => $description
            ]);
            return response()->json((array("code" => 200, "status" => "success", "message" => "insert successful.")));
        } catch (Exception $err) {
            return response(array(
                "code" => 400, "status" => "error", "message" => $err->getMessage()
            ), 400);
        }
    }

    public function putPost(Request $request, $id)
    {
        try {
            $title = $request->get("title");
            $description = $request->get("description");
            $data = Post::where('id', $id)->update([
                'title' => $title,
                'description' => $description
            ]);
            return response()->json((array("code" => 200, "status" => "success", "message" => "update successful.")));
        } catch (Exception $err) {
            return response()->json(
                array(
                    "code" => 500, "status" => "error", "message" => $err->getMessage()
                )
            );
        }
    }

    public function deletePost($id)
    {
        try {
            $data = Post::where('id', $id)->delete();
            return response()->json((array("code" => 200, "status" => "success", "message" => "delete successful.")));
        } catch (Exception $err) {
            return response(500)->json(
                array(
                    "code" => 500, "status" => "error", "message" => $err->getMessage()
                )
            );
        }
    }
}
