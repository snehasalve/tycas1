<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Validator;
class CategoryController extends Controller
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
        

        $getCategory=Category::all();
        $count=Category::all()->count();
        
       // return $count;
       try{
        if($count == 0)
        {
            //return "no category found";
            return $this->sendResponse('','No Category Found',false);
        }
        if($getCategory){
        return $this->sendResponse(['Category'=>$getCategory,'Count'=>$count],'Data Fetched Successfully...',true);
        }
        }
        catch(\Exception $e){
        return "in catch";
         }
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          

         
          try{
            $validator=Validator::make($request->all(),[
                'name'=>'required | string',
                
                
            ]);
            if($validator->fails()){
                return $this->sendError('Validator Error',$validator->errors());
            }

            $newCat= new Category;
                $newCat->client_id= $request->client_id;
                $newCat->name =  $request->name;
                $newCat->image= $request->image;
               

                $newCat->save();

                return $this->sendResponse(['Category' => $newCat], 'Data Save Successfully', true);
            

        }
        catch(\Exception $e){
            return $this->sendError('Something Wents Wrong',$e,412);
        }
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         
         $getCategory = Category::find($id);
            try{
                if(is_null($getCategory)){
                    return $this->sendResponse(['Category'=>$getCategory],'No Category Found',false);
                }
                else{
                    return $this->sendResponse(['Category'=>$getCategory] ,"Data Fetched Successfully..!",true);
                }
            }
            catch(\Exception $e){
                return $this->sendError('Something Went Wrong', $e, 413);
            } 

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
       
        $getCategory=Category::find($id);
        if(is_null($getCategory)){
            return $this->sendResponse(['Category'=>$getClient],'No Category Found',false);
        }
        if ($request->has('client_id')) {
            $getCategory->client_id = $request->client_id;
        }

        if ($request->has('name')) {
            $getCategory->name = $request->name;
        }
         if ($request->has('image')) {
            $getCategory->image = $request->image;
        }
        
        $getCategory->save();
                return $this->sendResponse(['Category'=>$getCategory],"Data Update Successfully..!",True);
    }
        catch(\Exception $e){
                return $this->sendError("Operation Failed",$e,413);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        try{
        $getCategory= Category::find($id);
        if(is_null($getCategory)){
            return $this->sendResponse([],'No Category Found',false);
        }
        if($getCategory->delete()){
            return $this->sendResponse([],'Category Deleted Successfully..!');
        }
        else{
            return $this->sendResponse([],'Category Not Deleted',false);
        }
    }
    catch(\Exception $e){
        return $this->sendError("Operation Failed",$e,413);
    }
}
    
}
