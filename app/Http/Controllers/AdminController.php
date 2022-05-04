<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class AdminController extends Controller
{
    public function upload() {
        return view('admin.upload');
    }

    public function store(Request $request) {

        $path = $request->file(key: 'csv_file')->getRealPath();
        $records = array_map('str_getcsv', file($path));

        if (count($records) <= 1) {
            return redirect('upload')->with('failure', "No records found in the uploaded file");
         }


          // Get field names from header column

        $fields = array_map(function ($field) {      
            return str_replace(" ", "_", strtolower($field));
        }, $records[0]);
        
        // Remove the header column
        array_shift($records);
       
        foreach ($records as $record) {
            if (count($fields) != count($record)) {
                return redirect('upload')->with('failure', "Invalid csv file");
            }
            // Decode unwanted html entities
            $record =  array_map("html_entity_decode", $record);
            
            // Set the field name as key
            $record = array_combine($fields, $record);

            // Get the clean data
            $this->rows[] = $this->clear_encoding_str($record);
        }

        foreach ($this->rows as $index => $data) {
            
            // Check if data has correct key values
            if (!isset($data['naziv_knjige']) 
             && !isset($data['autor']) 
             && !isset($data['izdavac']) 
             && !isset($data['godina_izdanja'])) {
                return redirect('upload')->with('failure', "Invalid field names in the uploaded file.");
             }
             // Check to see if date field is in proper format
             $date_regex = "/[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}/i";
             if(!preg_match($date_regex, $data['godina_izdanja'])) {
                 $index++;
                return redirect('upload')
                ->with('failure', "Publishing date not formated correcty. Use mm/dd/yyyy format at row {$index}.");
             }
            
            {Book::create([
               'naziv_knjige' => $data['naziv_knjige'],
               'autor' => $data['autor'],
               'izdavac' => $data['izdavac'],
               'godina_izdanja' => $data['godina_izdanja'],
            ]);}
        }
        return redirect('/')->with('success', 'CSV uploaded');
    }

    private function clear_encoding_str($value)
    {
        if (is_array($value)) {
            $clean = [];
            foreach ($value as $key => $val) {
                $clean[$key] = mb_convert_encoding($val, 'UTF-8', 'UTF-8');
            }
            return $clean;
        }
        return mb_convert_encoding($value, 'UTF-8', 'UTF-8');
    }

}
