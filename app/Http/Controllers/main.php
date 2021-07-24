<?php

namespace App\Http\Controllers;

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
      $cmdJPG = 'pdftoppm -jpeg -r 120 '. $pdfInFile . ' ' . $jpgout ;
      $pdf2jpg = system($cmdJPG);
	  $jpgout = 'storage/uploads/jpg/'.preg_replace('/.pdf/', '', $pdfName).'-1.jpg';
      $map->path = $jpgout;
      $map->name = $request->map_name;
      $map->save();
      return preg_replace('/app\/public/', '', $jpgout);

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

        $overlay->save();
    
        return response()->json([
            "message" => "Overlay added"
        ], 201);
    } else { return "err";}
    }
    public function retriveOverlay() {
    $overlays = overlays::get()->toJson(JSON_PRETTY_PRINT);
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

}
