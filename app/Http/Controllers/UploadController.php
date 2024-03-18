<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Models\Post;
use App\Models\Collection;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{

    // Controller method to handle file upload and processing
    public function uploadAndProcess(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:zip|max:2048', // Ensure it's a .zip file
        ]);

        try {


            $file = $request->file('file'); // Get the file
            $fileName = $file->getClientOriginalName(); // Get the original filename
            $file->move(storage_path('app/uploads'), $fileName); // Move the file to storage/app/uploads directory

            // Unzip the file
            $zip = new ZipArchive;
            $zip->open(storage_path('app/uploads/' . $fileName));

            // Extract and list files
            $fileList = [];
            $directoryList = [];

            for ($i = 0; $i < $zip->numFiles; $i++) {
                $filename = $zip->getNameIndex($i);
                $directoryName = '';

                // Check if the entry is a directory
                if (substr($filename, -1) === '/') {
                    // It's a directory
                    $directory = rtrim($filename, '/'); // Remove the trailing slash
                    $sections = explode('/', $directory); // Split the directory into sections
                    $directoryName = end($sections); // Get the last part of the array
                    $directoryList[] = [
                        'name' => $directoryName
                    ];
                } else {
                    // It's a file
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                    if ($extension !== 'json') { // ignore the json config files
                        $directory = $filename;
                        $sections = explode('/', $directory); // Split the directory into sections
                        $collectionName = $sections[1]; // "blog"
                        $fileContents = $zip->getFromIndex($i); // Get the contents of the file
                        $fileList[] = [
                            'name' => basename($filename),
                            'collection' => $collectionName, // Associate file with its collection
                            'content' => $fileContents
                        ];
                    }
                }
            }

            $zip->close();

            // delete the stored zip
            Storage::delete(storage_path('app/uploads/' . $fileName));

            // create the collections
            foreach ($directoryList as $directoryName) {
                $collection = new Collection();
                $collection->name = $directoryName['name'];
                $collection->url = $directoryName['name'];
                $collection->save(); // Save the new collection to the database
            }

            // save the posts 
            foreach ($fileList as $fileName) {
                $collection = Collection::where('name', $fileName['collection'])->first();
                $post = new Post(['title' => $fileName['name'], 'collection_id' => $collection->id, 'content' => $fileName['content']]);
                $post->save(); // Save the new collection to the database
            }

            // Return the list of file names
            return response()->json('success', 200);
        } catch (Exception $e) {
            return response()->json('Failed', 500);
        }
    }
};
