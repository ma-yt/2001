<?php
namespace App\Http\Response;


trait JsonResponse{

    public function error($msg='',$data=[]){
        return $this->jsonResponse('-1',$msg,$data);
    }

    public function success($msg='',$data=[]){
        return $this->jsonResponse('0',$msg,$data);
    }

    public function jsonResponse($code,$msg,$data=[]){
        $data = [
            'code'=>$code,
            'msg'=>$msg,
            'data'=>$data
        ];
        return response()->json($data);
    }
}