<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;

class ProductExport implements FromView, WithEvents
{
	public function view(): View
	{
		return view('exports.product', [
			'products' => Product::with(['category'])->orderBy('popular', 'desc')->orderBy('name', 'asc')->get(),
		]);
	}

	public function registerEvents(): array
	{
		
		$headerStyle = [
			'font' => [
				'bold' => true,
			],
			'alignment' => [
				'wrapText' => true,
				'horizontal' => Alignment::HORIZONTAL_CENTER,
				'vertical' => Alignment::VERTICAL_CENTER,
			],
		];
		$borderStyle = [
		  'borders' => [
			  'allBorders' => [
				  'borderStyle' => Border::BORDER_THIN,
				  'color' => ['argb' => '000000'],
			  ],
		  ],
		];
		return [
			AfterSheet::class => function (AfterSheet $event) use ($headerStyle, $borderStyle) {
				//Freeze frist row
				$event->sheet->freezePane('A2', 'A2');

				$products = Product::with(['category'])->orderBy('popular', 'desc')->orderBy('name', 'asc')->get()->map(function ($product){
								$barcode = new BarcodeGenerator();
								$barcode->setText($product->code);
								$barcode->setType(BarcodeGenerator::Code128);
								$barcode->setScale(2);
								$barcode->setThickness(11);
								$barcode->setFontSize(11);
								$code = $barcode->generate();
								$path = public_path('images/products/barcodes/'. $product->id .'_barcode.png');
								$data = base64_decode($code);
								File::makeDirectory(public_path('images/products/barcodes/'), $mode = 0777, true, true);
								file_put_contents($path, $data);
								return $product;
							});
				
				// Set Table Thead Format
				$event->sheet->getStyle('A1:Z1')->applyFromArray($headerStyle);
				$event->sheet->getRowDimension(1)->setRowHeight(25);
				$event->sheet->getStyle('A1:H1')->applyFromArray($borderStyle);

				for ($i = 0; $i < count($products); $i++)
				{
					$event->sheet->getRowDimension($i+2)->setRowHeight(60);
					$event->sheet->getStyle('A'.($i+2).':H'. ($i+2) )->applyFromArray($borderStyle);
				}
				$event->sheet->getColumnDimension('A')->setWidth(5);
				$event->sheet->getColumnDimension('B')->setWidth(20);
				$event->sheet->getColumnDimension('C')->setWidth(11.5);
				$event->sheet->getColumnDimension('D')->setWidth(25);
				$event->sheet->getColumnDimension('E')->setWidth(25);
				$event->sheet->getColumnDimension('F')->setWidth(25);

				foreach ($products as $key => $product) {
					$barcode = new Drawing();
					$barcode->setName('image');
					$barcode->setDescription('image');
					$barcode->setPath(public_path('images/products/barcodes/'. $product->id .'_barcode.png'));
					$barcode->setWidth(130);
					$barcode->setOffsetX(5);
					$barcode->setOffsetY(5);
					$barcode->setCoordinates('B' . ($key+2));
					$barcode->setWorksheet($event->sheet->getDelegate());

					if ($product->image) {
						$image = new Drawing();
						$image->setName('image');
						$image->setDescription('image');
						$image->setPath(public_path('images/products/'. $product->image));
						$image->setHeight(70);
						$image->setOffsetX(5);
						$image->setOffsetY(5);
						$image->setCoordinates('C' . ($key+2));
						$image->setWorksheet($event->sheet->getDelegate());
					}
				}
			},
		];
	}

}
