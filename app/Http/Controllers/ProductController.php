<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    public function import()
    {
        return view('import');
    }

    public function importCSV(Request $request)
    {
        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');
            $csvData = file_get_contents($file);
            $rows = explode(PHP_EOL, $csvData);
            $header = true;
            foreach ($rows as $row) {
                $data = str_getcsv($row);
                if ($header) {
                    $header = false; // Skip the first row
                    continue;
                }
                if (count($data) == 2) {
                    $product = new Product();
                    $product->name = $data[0];
                    $product->price = $data[1];
                    $product->save();
                }
            }
            return redirect()->back()->with('success', 'CSV imported successfully.');
        }
        return redirect()->back()->with('error', 'Please upload a CSV file.');
    }

    public function export()
    {
        return view('export');
    }

    public function exportCSV(Request $request)
    {
        $products = Product::all();

        // Define CSV file headers
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=products.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        // Create CSV file
        $callback = function () use ($products) {
            $file = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($file, ['Name', 'Price']);

            // Add data rows
            foreach ($products as $product) {
                fputcsv($file, [$product->name, $product->price]);
            }

            fclose($file);
        };

        // Return CSV file as response
        return Response::stream($callback, 200, $headers);
    }
}
