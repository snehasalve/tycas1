<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Models\Food_item;
class Food_itemController extends Controller
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
        $getFood_item=Food_item::all();
        $count=Food_item::all()->count();
        
       // return $count;
       try{
        if($count == 0)
        {
            //return "no category found";
            return $this->sendResponse('','No Food item Found',false);
        }
        if($getFood_item){
        return $this->sendResponse(['Food_item'=>$getFood_item,'Count'=>$count],'Data Fetched Successfully...',true);
        }
        }
        catch(\Exception $e){
        return $this->sendError('Something Wents Wrong',$e,412);
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
                'base_price'=>'required'
                
            ]);
            if($validator->fails()){
                return $this->sendError('Validator Error',$validator->errors());
            }

            $newFood= new Food_item;
                $newFood->client_id= $request->client_id;
                $newFood->name =  $request->name;
                $newFood->image= $request->image;
                $newFood->base_price= $request->base_price;
                $newFood->category_id= $request->category_id;
                $newFood->item_status= $request->item_status;
                $newFood->is_drink= $request->is_drink;
                $newFood->is_hard_drink= $request->is_hard_drink;
                $newFood->save();

                return $this->sendResponse(['Food_item' => $newFood], 'Data Save Successfully', true);
            

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
          $getFood_item = Food_item::find($id);
            try{
                if(is_null($getFood_item)){
                    return $this->sendResponse(['Food_item'=>$getFood_item],'No Food_item Found',false);
                }
                else{
                    return $this->sendResponse(['Food_item'=>$getFood_item] ,"Data Fetched Successfully..!",true);
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
       
        $getFood_item=Food_item::find($id);
        if(is_null($getFood_item)){
            return $this->sendResponse(['Food_item'=>$getFood_item],'No Food_item Found',false);
        }
        if ($request->has('client_id')) {
            $getFood_item->client_id = $request->client_id;
        }

        if ($request->has('name')) {
            $getFood_item->name = $request->name;
        }
         if ($request->has('image')) {
            $getFood_item->image = $request->image;
        }
        if ($request->has('base_price')) {
            $getFood_item->base_price = $request->base_price;
        }

        if ($request->has('category_id')) {
            $getFood_item->category_id = $request->category_id;
        }

        if ($request->has('item_status')) {
            $getFood_item->item_status = $request->item_status;
        }

        if ($request->has('is_drink')) {
            $getFood_item->is_drink = $request->is_drink;
        }

        if ($request->has('is_hard_drink')) {
            $getFood_item->is_hard_drink = $request->is_hard_drink;
        }
        
        $getFood_item->save();
                return $this->sendResponse(['Food item'=>$getFood_item],"Data Update Successfully..!",True);
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
        $getFood_item= Food_item::find($id);
        if(is_null($getFood_item)){
            return $this->sendResponse([],'No Food item Found',false);
        }
        if($getFood_item->delete()){
            return $this->sendResponse([],'Food_item Deleted Successfully..!');
        }
        else{
            return $this->sendResponse([],'Food item Not Deleted',false);
        }
    }
    catch(\Exception $e){
        return $this->sendError("Operation Failed",$e,413);
    }
    }
}
