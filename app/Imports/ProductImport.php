<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\ProductCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductImport implements ToModel, WithHeadingRow, WithValidation
{
	
	public function rules(): array
	{
		return [
			'label' => ['required', 'string', 'min:3', 'max:255', 'unique:products,label'],
			'name' => ['required', 'string', 'min:3', 'max:255', 'unique:products,name'],
			'cost' => ['required', 'numeric', 'between:0,1000000'],
			'price' => ['required', 'numeric', 'between:0,1000000'],
			'uom' => ['required', 'max:255'],
			'category' => ['required', 'max:255'], 
		];
	}

	public function model(array $row)
	{
		$code = ((Product::where('manual_code', false)->exceptDiscount()->orderBy('code', 'desc')->first()->code ?? 0) + 1);
		if ($row['code']=='') {
			$row['code'] = str_pad($code, 6, '0', STR_PAD_LEFT);
		}
		$category = ProductCategory::where('name', $row['category'])->first();
		if ($category) {
			$row['category'] = $category->id;
		}else{
			throw ValidationException::withMessages(
				['category' => 'Category not found!']
			);
		}
		return Product::create([
							'code' => $row['code'],
							'label' => $row['label'],
							'name' => $row['name'],
							'category_id' => $row['category'],
							'cost' => $row['cost'],
							'price' => $row['price'],
							'uom' => $row['uom'],
							'sale_by_unit' => ($row['sale_by_unit']=='Yes'? true : false ),
							'tracking_stock' => ($row['tracking_stock']=='Yes'? true : false ),
							'popular' => ($row['popular']=='Yes'? true : false ),
							'description' => $row['description'],
							'created_by' => auth()->user()->id,
							'updated_by' => auth()->user()->id,
						]);
	}
}
