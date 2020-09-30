<?php


namespace App\Http\Controllers;
use App\Models\ManufacturerInfo;
use App\Http\Resources\ManufacturerResource;
use Illuminate\Http\Request;


class ManufacturerController
{
    public function index()
    {
        $manufacturers = ManufacturerInfo::withCount(['products' => function ($query) {
            $query->withFilters();
        }])
            ->get();

        return ManufacturerResource::collection($manufacturers);
    }
}
