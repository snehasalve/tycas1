<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\food_customization_option;
use Validator;
class Food_customization_optionController extends Controller
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
        $getFood_cust_opt=food_customization_option::all();
        $count=food_customization_option::all()->count();
        
       // return $count;
       try{
        if($count == 0)
        {
            //return "no category found";
            return $this->sendResponse('','No Food customization option Found',false);
        }
        if($getFood_cust_opt){
        return $this->sendResponse(['Food customization option'=>$getFood_cust_opt,'Count'=>$count],'Data Fetched Successfully...',true);
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
                'price'=>'required',
                
                
            ]);
            if($validator->fails()){
                return $this->sendError('Validator Error',$validator->errors());
            }

            $newFood_cust_opt= new food_customization_option;
                $newFood_cust_opt->name= $request->name;
                $newFood_cust_opt->price =  $request->price;
                $newFood_cust_opt->customization_type_id= $request->customization_type_id;
               

                $newFood_cust_opt->save();

                return $this->sendResponse(['Food customization option' => $newFood_cust_opt], 'Data Save Successfully', true);
            

        }
        catch(\Exception $e){
            return $this->sendError('Something Wents Wrong',$e,412);
        }

    }

    public function show($id)
    {
          $getFood_cust_opt= food_customization_option::find($id);
            try{
                if(is_null($getFood_cust_opt)){
                    return $this->sendResponse(['Food customization option'=>$getFood_cust_opt],'No Food_customization option Found',false);
                }
                else{
                    return $this->sendResponse(['Food customization option'=>$getFood_cust_opt] ,"Data Fetched Successfully..!",true);
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
       
        $getFood_cust_opt=food_customization_option::find($id);
        if(is_null($getFood_cust_opt)){
            return $this->sendResponse(['Food customization option'=>$getFood_cust_opt],'No Food customization option Found',false);
        }
        if ($request->has('name')) {
            $getFood_cust_opt->name = $request->name;
        }

        if ($request->has('price')) {
            $getFood_cust_opt->price = $request->price;
        }
         if ($request->has('customization_typt_id')) {
            $getFood_cust_opt->customization_type_id = $request->customization_type_id;
        }
       

       
        $getFood_cust_opt->save();
                return $this->sendResponse(['Food Customozation option'=>$getFood_cust_opt],"Data Update Successfully..!",True);
    }
        catch(\Exception $e){
                return $this->sendError("Operation Failed",$e,413);
            }
    }

     public function destroy($id)
    {
        try{
        $getFood_cust_opt= food_customization_option::find($id);
        if(is_null($getFood_cust_opt)){
            return $this->sendResponse([],'No Food Customozation option Found',false);
        }
        if($getFood_cust_opt->delete()){
            return $this->sendResponse([],'Food Customozation option Deleted Successfully..!');
        }
        else{
            return $this->sendResponse([],'Food Customization option Not Deleted',false);
        }
    }
    catch(\Exception $e){
        return $this->sendError("Operation Failed",$e,413);
    }
    }
}
