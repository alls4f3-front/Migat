<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\PackageResource;
use App\Http\Traits\UserResponseTrait;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    use UserResponseTrait;

    public function index(Request $request)
    {
        $query = Package::query();

        if ($request->has('id')) {
            $query->where('id', $request->id);
        }

        $packages = $query->latest()->paginate(10);

        return $this->success([
            'packages' => PackageResource::collection($packages),
            'pagination' => [
                'total' => $packages->total(),
                'per_page' => $packages->perPage(),
                'current_page' => $packages->currentPage(),
                'last_page' => $packages->lastPage(),
            ]
        ], 'Packages fetched');
    }

}
