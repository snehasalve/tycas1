<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\food_size_option;
use Validator;
class Food_size_optionController extends Controller
{
    public function sendResponse($result, $message,$status = true)
    {
        $response = [
            'success' => $status,
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($error, $errorMessages = [], $code = 412)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }

    public function index()
    {
        $getFood_size_opt=food_size_option::all();
        $count=food_size_option::all()->count();
        
       // return $count;
       try{
        if($count == 0)
        {
            
            return $this->sendResponse('','No Food size option Found',false);
        }
        if($getFood_size_opt){
        return $this->sendResponse(['Food option size'=>$getFood_size_opt,'Count'=>$count],'Data Fetched Successfully...',true);
        }
        }
        catch(\Exception $e){
        return $this->sendError('Something Wents Wrong',$e,412);
         }
    
    }

    public function store(Request $request)
    {
          

         
          try{
            $validator=Validator::make($request->all(),[
                'size'=>'required',
                'price'=>'required',
                
                
            ]);
            if($validator->fails()){
                return $this->sendError('Validator Error',$validator->errors());
            }

            $newFood_size_opt= new food_size_option;
                $newFood_size_opt->size= $request->size;
                $newFood_size_opt->price =  $request->price;
                $newFood_size_opt->food_item_id= $request->food_item_id;
               

                $newFood_size_opt->save();

                return $this->sendResponse(['Food size option' => $newFood_size_opt], 'Data Save Successfully', true);
            

        }
        catch(\Exception $e){
            return $this->sendError('Something Wents Wrong',$e,412);
        }

    }

    public function show($id)
    {
          $getFood_size_opt= food_size_option::find($id);
            try{
                if(is_null($getFood_size_opt)){
                    return $this->sendResponse(['Food size option'=>$getFood_size_opt],'No Food size option Found',false);
                }
                else{
                    return $this->sendResponse(['Food size option'=>$getFood_size_opt] ,"Data Fetched Successfully..!",true);
                }
            }
            catch(\Exception $e){
                return $this->sendError('Something Went Wrong', $e, 413);
            } 

    }

    public function update(Request $request, $id)
    {
        
         try{
        $validator= Validator::make($request->all(),[
            
            'size'=>'',
        ]);
        if($validator->fails())
        {
            return $this->sendError('Validation Error.',$validator->errors());
        }
       
        $getFood_size_opt=food_size_option::find($id);
        if(is_null($getFood_size_opt)){
            return $this->sendResponse(['Food size option'=>$getFood_size_opt],'No Food size option Found',false);
        }
        if ($request->has('size')) {
            $getFood_size_opt->size = $request->size;
        }

        if ($request->has('price')) {
            $getFood_size_opt->price = $request->price;
        }
         if ($request->has('food_item_id')) {
            $getFood_size_opt->food_item_id = $request->food_item_id;
        }
       

       
        $getFood_size_opt->save();
                return $this->sendResponse(['Food size option'=>$getFood_size_opt],"Data Update Successfully..!",True);
    }
        catch(\Exception $e){
                return $this->sendError("Operation Failed",$e,413);
            }
    }

     public function destroy($id)
    {
        try{
        $getFood_size_opt= food_size_option::find($id);
        if(is_null($getFood_size_opt)){
            return $this->sendResponse([],'No Food size option Found',false);
        }
        if($getFood_size_opt->delete()){
            return $this->sendResponse([],'Food size option Deleted Successfully..!');
        }
        else{
            return $this->sendResponse([],'Food size option Not Deleted',false);
        }
    }
    catch(\Exception $e){
        return $this->sendError("Operation Failed",$e,413);
    }
    }

}
