<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\food_customization_type;

class Food_customization_typesController extends Controller
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
        $getFood_cust_type=food_customization_type::all();
        $count=food_customization_type::all()->count();
        
       // return $count;
       try{
        if($count == 0)
        {
            //return "no category found";
            return $this->sendResponse('','No Food customization type Found',false);
        }
        if($getFood_cust_type){
        return $this->sendResponse(['No Food customization type'=>$getFood_cust_type,'Count'=>$count],'Data Fetched Successfully...',true);
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
                'name'=>'required | string',
                'min_selection_count'=>'required',
                'max_selection_count'=>'required'
                
            ]);
            if($validator->fails()){
                return $this->sendError('Validator Error',$validator->errors());
            }

            $newFood_cust_type= new food_customization_type;
                $newFood_cust_type->food_item_id= $request->food_item_id;
                $newFood_cust_type->name =  $request->name;
                $newFood_cust_type->min_selection_count= $request->min_selection_count;
                $newFood_cust_type->max_selection_count =  $request->max_selection_count;

                $newFood_cust_type->save();

                return $this->sendResponse(['Food customization type' => $newFood_cust_type], 'Data Save Successfully', true);
            

        }
        catch(\Exception $e){
            return $this->sendError('Something Wents Wrong',$e,412);
        }

    }

    public function show($id)
    {
          $getFood_cust_type= food_customization_type::find($id);
            try{
                if(is_null($getFood_cust_type)){
                    return $this->sendResponse(['Food customization type'=>$getFood_cust_type],'No Food_item Found',false);
                }
                else{
                    return $this->sendResponse(['Food customization type'=>$getFood_cust_type] ,"Data Fetched Successfully..!",true);
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
            
            'name'=>'string',
        ]);
        if($validator->fails())
        {
            return $this->sendError('Validation Error.',$validator->errors());
        }
       
        $getFood_cust_type=food_customization_type::find($id);
        if(is_null($getFood_cust_type)){
            return $this->sendResponse(['Food customization type'=>$getFood_cust_type],'No Food customization type Found',false);
        }
        if ($request->has('food_item_id')) {
            $getFood_cust_type->food_item_id = $request->food_item_id;
        }

        if ($request->has('name')) {
            $getFood_cust_type->name = $request->name;
        }
         if ($request->has('min_selection_count')) {
            $getFood_cust_type->min_selection_count = $request->min_selection_count;
        }
        if ($request->has('max_selection_count')) {
            $getFood_cust_type->max_selection_count = $request->max_selection_count;
        }

       
        $getFood_cust_type->save();
                return $this->sendResponse(['Food customization type'=>$getFood_cust_type],"Data Update Successfully..!",True);
    }
        catch(\Exception $e){
                return $this->sendError("Operation Failed",$e,413);
            }
    }


     public function destroy($id)
    {
        try{
        $getFood_cust_type= food_customization_type::find($id);
        if(is_null($getFood_cust_type)){
            return $this->sendResponse([],'No Food customization type Found',false);
        }
        if($getFood_cust_type->delete()){
            return $this->sendResponse([],'Food Customozation type Deleted Successfully..!');
        }
        else{
            return $this->sendResponse([],'Food Customization type Not Deleted',false);
        }
    }
    catch(\Exception $e){
        return $this->sendError("Operation Failed",$e,413);
    }
    }

}
