<?php

namespace App\Http\Controllers\API;

use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\SubCategoryRequest;

class SubCategoryController extends Controller
{
 public function store(SubCategoryRequest $request)
 {
    try {
        $subcategory = new Subcategory();
        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;
        $subcategory->created_by = auth()->id();
        $subcategory->save();
        return response()->json(['message' => 'Subcategory created successfully'], 201);
    } catch (\Throwable $th) {

        return response()->json(['message' => 'Failed to create subcategory'], 500);
    }
 }

 public function update(SubCategoryRequest $request, $subcategory)
{
    try {
        $subcategory = Subcategory::findOrFail($subcategory);
        $subcategory->name = $request['name'];
        $subcategory->category_id = $request['category_id'];
        $subcategory->created_by = auth()->id();

        $subcategory->update([
            'category_id' => $subcategory->category_id,
            'name' => $subcategory->name,
        ]);
        return response()->json(['message' => 'Subcategory updated successfully'], 200);
    } catch (\Throwable $th) {
        return response()->json(['message' => 'Failed to update subcategory'], 500);
    }
}


public function destroy($subcategory)
{
    try {
        $subcategory = Subcategory::findOrFail($subcategory);

        // Soft delete the subcategory
        $subcategory->delete();

        return response()->json(['message' => 'Subcategory deleted successfully'], 200);
    } catch (\Throwable $th) {
        return response()->json(['message' => 'Failed to delete subcategory'], 500);
    }
}

  /**
     * wrap a result into json response.
     *
     * @param  int $code
     * @param  string $message
     * @param  array $resource
     * @return JsonResponse
     */
    private function wrapResponse(int $code, string $message, ?array $resource = []): JsonResponse
    {
        $result = [
            'code' => $code,
            'message' => $message
        ];

        if (count($resource)) {
            $result = array_merge($result, ['data' => $resource['data']]);

            if (count($resource) > 1)
                $result = array_merge($result, ['pages' => ['links' => $resource['links'], 'meta' => $resource['meta']]]);
        }

        return response()->json($result, $code);
    }
}
