<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //
        $supplier = Supplier::all();
        return response()->json($supplier);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validateData = $request->validate([
            'name' => 'required|unique:suppliers',
            'email' => 'required|email|max:50|unique:suppliers',
            'address' => 'required',
            'phone' => 'required',
            'shop_name' => 'required',
        ]);
        if ($request->photo) {
//            image position in console:=>    data:image/jpeg;base64,/9j/
//            get only: image/jpeg position as an index:
            $position = strpos($request->photo, ';');
//            get  image/jpg
            $sub = substr($request->photo, 0, $position);
//            remove /
            $ext = explode('/', $sub)[1];
            $name = time() . "." . $ext;
//            image intervention pkg
            $img = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'backend/suppliers/';
            $image_url = $upload_path . $name;
            $img->save($image_url);
//save employee data
            $supplier = new Supplier();
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->shop_name = $request->shop_name;
            $supplier->address = $request->address;
            $supplier->photo = $image_url;
            $supplier->save();
        } else {
            $supplier = new Supplier();
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->shop_name = $request->shop_name;
            $supplier->address = $request->address;
            $supplier->save();


        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        //
        $supplier = Supplier::findOrFail($id);
        return response()->json($supplier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = array();
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['photo'] = $request->photo;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['shop_name'] = $request->shop_name;

        $image = $request->newphoto;
        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time() . "." . $ext;
            $img = Image::make($image)->resize(240, 200);
            $upload_path = 'backend/suppliers/';
            $image_url = $upload_path . $name;
            $success = $img->save($image_url);

            if ($success) {
                $data['photo'] = $image_url;
                $img = DB::table('suppliers')->where('id', $id)->first();
                $image_path = $img->photo;
                $done = unlink($image_path);
                $user = DB::table('suppliers')->where('id', $id)->update($data);
            }

        } else {
            $oldphoto = $request->photo;
            $data['photo'] = $oldphoto;
            $user = DB::table('suppliers')->where('id', $id)->update($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $supplier = Supplier::findOrFail($id);
        $photo = $supplier->photo;
        if ($photo) {
            unlink($photo);
            DB::table('suppliers')->where('id', $id)->delete();
        } else {
            DB::table('suppliers')->where('id', $id)->delete();

        }
    }
}
