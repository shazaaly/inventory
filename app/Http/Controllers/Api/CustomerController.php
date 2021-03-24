<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Customer;
use App\Model\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //
        $customer = DB::table('customers')->orderBy('id', 'DESC')->get();
        return response()->json($customer);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
            'name' => 'required',
            'email' => 'required|email|max:50|unique:employees',
            'address' => 'required',
            'phone' => 'required',
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
            $upload_path = 'backend/customer/';
            $image_url = $upload_path . $name;
            $img->save($image_url);
//save employee data
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;

            $customer->address = $request->address;
            $customer->photo = $image_url;
            $customer->save();
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
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
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
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $image = $request->newphoto;

        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time() . "." . $ext;
            $img = Image::make($image)->resize(240, 200);
            $upload_path = 'backend/customer/';
            $image_url = $upload_path . $name;
            $success = $img->save($image_url);

            if ($success) {
                $data['photo'] = $image_url;
                $img = DB::table('customers')->where('id', $id)->first();
                $image_path = $img->photo;
                $done = unlink($image_path);
                $user = DB::table('customers')->where('id', $id)->update($data);
            }

        } else {
            $oldphoto = $request->photo;
            $data['photo'] = $oldphoto;
            $user = DB::table('customers')->where('id', $id)->update($data);
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
        $customer = DB::table('customers')->where('id', $id)->first();
        $photo = $customer->photo;
        if ($photo) {
            unlink($photo);
            DB::table('customers')->where('id', $id)->delete();

        } else {
            DB::table('customers')->where('id', $id)->delete();


        }
    }
}
