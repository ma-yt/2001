<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Requests\StoreBrandPost;
use Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand_name = request()->brand_name;
        $where = [];
        if($brand_name){
            $where[] = ['brand_name','like',"%$brand_name%"];
        }

        $brand_url = request()->brand_url;
        $where = [];
        if($brand_url){
            $where[] = ['brand_url','like',"%$brand_url%"];
        }
        $data = Brand::where($where)->orderBy('brand_id','desc')->paginate(5);
        if(request()->ajax()){
            return view('admin.brand.ajaxpage',['data'=>$data,'query'=>request()->all()]);
        }
        return view('admin.brand.index',['data'=>$data,'query'=>request()->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
        //表单验证2
    //public function store(StoreBrandPost $request)
    {

        //表单验证1
//        $validatedData = $request->validate([
//            'brand_name' => 'required|unique:brand',
//            'brand_url' => 'required',
//        ],[
//            'brand_name.required'=>'品牌名称不能为空',
//            'brand_name.unique'=>'品牌名称已存在',
//            'brand_url.required'=>'品牌网址不能为空',
//        ]);

        ////表单验证3
        $validator = Validator::make($request->all(),
            [
                'brand_name' => 'required|unique:brand',
                'brand_url' => 'required',
            ],[
                'brand_name.required'=>'品牌名称不能为空',
                'brand_name.unique'=>'品牌名称已存在',
                'brand_url.required'=>'品牌网址不能为空',
            ]);
        if ($validator->fails()){
            return redirect('brand/create')
                ->withErrors($validator)
                ->withInput();
        }
        $res = $request->except(['_token','file']);
        $data = Brand::create($res);
        if($data){
            return redirect('/brand');
        }

    }

    public function upload(Request $request){
        if ($request->hasFile('file') && $request->file('file')->isValid()){
            $photo = $request->file;

            $store_result = $photo->store('upload');

            //return $this->success('上传成功');
            return json_encode(['code'=>0,'msg'=>'上传成功','data'=>env('IMG_URL').$store_result]);
        }
        return $this->error('上传失败');
        //return json_encode(['code'=>2,'msg'=>'上传失败']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Brand::find($id);
        return view('admin.brand.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBrandPost $request, $id)
    {
        $post = $request->except(['_token','file']);

        $res = Brand::where('brand_id',$id)->update($post);
        if($res){
            return redirect('/brand');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id=0)
    {
        $id = request()->id?:$id;
        if(!$id){
            return;
        }
        $res = Brand::destroy($id);
        if(request()->ajax()){
                return $this->success('删除成功');
                //return response()->json(['code'=>0,'msg'=>'删除成功']);
        }
        if($res){
            return redirect('/brand');
        }
    }

    public function change(Request $request){
        $newname = $request->newname;
        $id = $request->id;

        if(!$newname || !$id){
            return $this->error('缺少参数');
            //return response()->json(['code'=>3,'msg'=>'缺少参数']);
        }

        $res = Brand::where('brand_id',$id)->update(['brand_name'=>$newname]);
        if($res){
            return $this->success('修改成功');
            //return response()->json(['code'=>0,'msg'=>'修改成功']);
        }
    }
}
