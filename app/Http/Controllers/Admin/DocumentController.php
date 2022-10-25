<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->model = Document::query();
    }

    public function index()
    {
        return view('admin.document.index');
    }

    public function create()
    {
        return view('admin.document.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $blocks=json_encode($request->all());
            Document::create(['content' => $blocks]);
            DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();
            dd($exception);
        }
    }

    public function show(Document $id)
    {
        return view('admin.document.show',[
            'document'=>$id
        ]);
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try{
            $id=$request->id;
            Document::find($id)->delete();
            DB::commit();
            return response()->json(['success'=>'Xóa thành công bài viết']);
        }
        catch(\Throwable $e){
            DB::rollBack();
            return response()->json(['error'=>'Đã xảy ra lỗi']);
        }
    }

    public function storeImageFromUploaded(Request $request)
    {
        try {

            $name = Hash::make(5);
            $path = Storage::disk('public')
                ->putFileAs('image', $request->image, $name . '.jpg');
            return response()->json([
                'success' => 1,
                'file' => [
                    'url' => Storage::url($path)
                ]
            ]);

        } catch (\Throwable $exception) {
            dd($exception);
            return response()->json(['sucesss' => 0]);
        }
    }

    public function storeAttachmentFromUploaded(Request $request)
    {
        try {
            $extension = $request->file->getClientOriginalExtension();
            $name = Hash::make(5);
            $path = Storage::disk('public')
                ->putFileAs('file/', $request->file, $name . '.' . $extension);
            return response()->json([
                'success' => 1,
                'file' => $path
            ]);

        } catch (\Throwable $exception) {
            return response()->json(['sucesss' => 0]);
        }

    }
}
