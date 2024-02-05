<?php

namespace App\Imports;

use App\Models\Unit;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsImport implements ToModel, WithHeadingRow, WithHeadings
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $units;

    public function __construct()
    {
        $this->units = Unit::all();
    }

    public function model(array $row)
    {
        $unit = $this->units->where('name', $row['unit'])->first();
        return new Product([
            'name' => $row['name'],
            'code' => $row['code'],
            'unit_id' => $unit->id ?? null,
            'tension' => $row['tension'],
            'price' => $row['price'],
            'code_type' => $row['code_type'],
        ]);
    }

    public function headings(): array
    {
        return [
            'name',
            'code',
            'unit',
            'tension',
            'price',
            'code_type'
        ];
    }
}