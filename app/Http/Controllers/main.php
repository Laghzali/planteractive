<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\overlays;
use App\Models\maps;
class main extends Controller
{


  public function retriveMaps() {
    $maps = maps::get()->toJson(JSON_PRETTY_PRINT);
    return response($maps, 200);
  }

  public function newMap2jpg(Request $request) {
    $map = new maps;
    if($request->file()) {
      $pdfName = preg_replace('/\s+/', '', time().$request->map_pdf->getClientOriginalExtension());
      $mapPath = $request->file('map_pdf')->storeAs('uploads/pdfs', $pdfName, 'public');
	 
      $pdfInFile = getCWD().'/storage/'. $mapPath;
      $jpgout = storage_path('app/public/uploads/jpg/'.preg_replace('/.pdf/', '', $pdfName));
      $rotate90 = "convert -rotate -90 " . $jpgout . '-1.jpg ' . $jpgout. '-1.jpg ' ;
	
      $rotate = system($rotate90);
	  
      $cmdJPG = 'pdftoppm -jpeg -r 72 '. $pdfInFile . ' ' . $jpgout ;
      $pdf2jpg = system($cmdJPG);
	    $jpgout = 'storage/uploads/jpg/'.preg_replace('/.pdf/', '', $pdfName).'-1.jpg';
	    $rotate = system($rotate90);
      $map->path = $jpgout;
      $map->name = $request->map_name;
      $map->save();
      $resp = maps::where('id', $map->id)->get()->toJson(JSON_PRETTY_PRINT);
      return response($resp, 200);

    }


  }

   public function saveOverlay(Request $request) {

        $overlay = new overlays;
        if($request->file()) {
            $uploadPic = time().'_'.$request->image->getClientOriginalName();
            $picPath = $request->file('image')->storeAs('uploads', $uploadPic, 'public');
            $overlay->element = "overlay";
            $overlay->x = $request->x;
            $overlay->image = '/storage/' .$picPath;
            $overlay->y = $request->y;
            $overlay->symbol = $request->symbol;
            $overlay->color = $request->color;
            $overlay->name = $request->name;
            $overlay->note = $request->note;
            $overlay->map_id = $request->map_id;

        $overlay->save();
    
        return response()->json([
            "message" => "Overlay added"
        ], 201);
    } else { return "err";}
    }
    public function saveExistingOverlay(Request $request) {

      $overlay = new overlays;

          $overlay->element = "overlay";
          $overlay->x = $request->x;
          $overlay->image = $request->image;
          $overlay->y = $request->y;
          $overlay->symbol = $request->symbol;
          $overlay->color = $request->color;
          $overlay->name = $request->name;
          $overlay->note = $request->note;
          $overlay->map_id = $request->map_id;

         if(  $overlay->save() ){
  
            return response()->json([
                "message" => "Overlay added"
            ], 201);
          }
  }



    public function retriveOverlay(Request $request) {
    //$overlays = overlays::get()->toJson(JSON_PRETTY_PRINT);
    $overlays = maps::selectRaw('overlays.id as overlay_id , maps.id as map_overlay_id, overlays.name , overlays.x , overlays.y , overlays.symbol , overlays.image , overlays.note , overlays.color')
        ->join('overlays' , 'maps.id' , '='  , 'overlays.map_id')->where('map_overlay_id' , $request->map_id)->get()->toJson(JSON_PRETTY_PRINT);
    return response($overlays, 200);

    }
    public function retriveLastOverlay() {
      $overlays = overlays::latest()->first()->toJson(JSON_PRETTY_PRINT);
      return response($overlays, 200);
  
      }
    public function deleteOverlay($id) {

        if(overlays::where('id', $id)->exists()) {
            $overlays = overlays::find($id);
            $overlays->delete();
    
            return response()->json([
              "message" => "records deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "overlay not found"
            ], 404);
          }
        }
   public function sendEmail(Request $request)
    {
        $request->validate([
          'contactEmail' => 'required|email',
          'contactName' => 'required',
          'contactMessage' => 'required',
        ]);

        $data = [
          'contactEmail' => $request->contactEmail,
          'contactName' => $request->contactName,
          'contactMessage' => $request->contactMessage
        ];

        Mail::send('email-template', $data, function($message) use ($data) {
          $message->to('mohamed.laghzali@uit.ac.ma')
          ->subject('OrderAid.com - Planteractive Contact Form');
        });

        return back()->with(['message' => 'Email successfully sent!']);
    }

}
