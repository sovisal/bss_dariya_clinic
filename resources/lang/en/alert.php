<?php

use App\Models\Sale;

return [

	'modal' => [
		'confirm_password' => 'This action require password to continue.',
		'crop_image' => 'Crop Image',
		'checkout' => 'Checkout',
		'item_detail' => 'Item Detail',
		'import' => 'Import From Excel',
		'export' => 'Export To Excel',
		'add_item' => 'Add Item',
		'hold_order' => 'Hold Order',
		'note' => 'Note',
	],

	'swal' => [
		'title' => [
			'success' => 'Successful.',
			'empty' => 'Please input password.',
			'wrong_password' => 'Password you enter is in valid!',
			'sure' => 'Are you Sure?',
			'all_fields_required' => 'Please input all require field.',
			'confirm' => 'Confirm:',
		],
		'text' => [
			'remove' => 'Do you really want to remove this data?',
			'complete_sale' => 'You won\'t be able to revert this action. Do you want to complete this sale?',
			'change_customer' => 'Do you really want to change Customer?',
			'remove_held_order' => 'Do you really want to Remove this Held Order?',
			'add_held_items_to_order' => 'Do you really want to Add these items to your current sale?',
			'remove_item' => 'Do you really want to remove this item?',
			'close_shift' => 'You won\'t be able to revert this. Do you really want to close shift for now?',
		],
		'btn' => [
			'confirm' => 'Confirm',
			'ok' => 'Okay',
			'yes' => 'Yes',
			'no' => 'No',
		],
	],

	'message' => [
		'success' => [
			'delete_attachment' => 'Attachment has been deteled successfully.',
			'crud' => [
				'create' => 'Data has been created successfully.',
				'update' => 'Data has been updated successfully.',
				'delete' => 'Data has been deleted successfully.',
				'import' => 'Data has been Imported successfully.',
			],
			'backup' => 'Database has been Backup successfully.',
		],
		'warning' => [
			'success' => 'Successful!',
			'crud' => [
				'create' => 'Data has been created with a warning.',
				'update' => 'Data has been updated with a warning.',
				'delete' => 'Data has been deleted with a warning.',
				'import' => 'Data has been Imported with a warning.',
			],
		],
		'error' => [
			'error' => 'Error!',
			'page_not_found' => 'Page Not Found',
			'data_not_found' => 'Data Not Found',
			'we_could_not_find_your_page' => 'we couldn\'t find the page you are looking for',
			'crud' => [
				'create' => 'Data has not been created.',
				'update' => 'Data has not been updated.',
				'delete' => 'Data has not been deleted.',
				'import' => 'Data has not been Imported.',
			],
			'something_went_wrong' => 'Something went wrong',
		],
	],
];
