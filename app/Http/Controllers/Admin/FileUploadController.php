<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Exception;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class FileUploadController extends Controller
{
    public function upload(Request $request) {
        try {

            $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

            if (!$receiver->isUploaded()) {
                // file not uploaded
            }

            $fileReceived = $receiver->receive(); // receive file
            if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
                $file = $fileReceived->getFile(); // get file
                $extension = $file->getClientOriginalExtension();
                $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName()); //file name without extenstion
                $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name

                $disk = Storage::disk(config('filesystems.default'));
                $path = "";
                if($extension == "mp3")
                    $path = $disk->putFileAs('audios', $file, $fileName);
                else
                    $path = $disk->putFileAs('videos', $file, $fileName);

                // delete chunked file
                unlink($file->getPathname());
                return [
                    'path' => asset('storage/' . $path),
                    'filename' => $fileName
                ];
            }

            // otherwise return percentage information
            $handler = $fileReceived->handler();
            return [
                'done' => $handler->getPercentageDone(),
                'status' => true
            ];
        }
        catch (Exception $ex){
            return [
                'error'=> true,
                'msg' => $ex
            ];
        }
    }
}
