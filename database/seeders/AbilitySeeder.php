<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\AbilityModule;
use Illuminate\Database\Seeder;

class AbilitySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		AbilityModule::insert([
			['module' => 'Sale'],
			['module' => 'ShiftSale'],
			['module' => 'Role'],
			['module' => 'User'],
			['module' => 'Customer'],
			['module' => 'Supplier'],
			['module' => 'Product'],
			['module' => 'ProductCategory'],
			['module' => 'Expense'],
			['module' => 'Income'],
			['module' => 'StockIn'],
			['module' => 'StockOut'],
			['module' => 'StockAdjustment'],
			['module' => 'StockBalance'],
			['module' => 'ReportSale'],
			['module' => 'ReportRevenue'],
			['module' => 'ReportExpense'],
			['module' => 'ReportProfitLoss'],
			['module' => 'ReportInventory']
		]);

		Ability::insert([

			[ 'ability_module_id' => '1', 'category' => 'Create', 'name' => 'Sale', 'label' => 'Sale' ],
			[ 'ability_module_id' => '1', 'category' => 'ViewAny', 'name' => 'ViewAnySaleTransaction', 'label' => 'Transaction View List' ],
			[ 'ability_module_id' => '2', 'category' => 'ViewAny', 'name' => 'ViewAnyShiftSale', 'label' => 'Shift Sale ViewAny' ],
			[ 'ability_module_id' => '2', 'category' => 'Create', 'name' => 'CreateShiftSale', 'label' => 'Shift Sale Create' ],
			[ 'ability_module_id' => '2', 'category' => 'Update', 'name' => 'UpdateShiftSale', 'label' => 'Shift Sale Update' ],
			[ 'ability_module_id' => '2', 'category' => 'Print', 'name' => 'PrintShiftSale', 'label' => 'Shift Sale Print' ],

			[ 'ability_module_id' => '3', 'category' => 'ViewAny', 'name' => 'ViewAnyRole', 'label' => 'Role View List' ],
			[ 'ability_module_id' => '3', 'category' => 'Create', 'name' => 'CreateRole', 'label' => 'Role Create' ],
			[ 'ability_module_id' => '3', 'category' => 'Update', 'name' => 'UpdateRole', 'label' => 'Role Update' ],
			[ 'ability_module_id' => '3', 'category' => 'Delete', 'name' => 'DeleteRole', 'label' => 'Role Delete' ],
			[ 'ability_module_id' => '3', 'category' => 'Other', 'name' => 'AssignRoleAbility', 'label' => 'Role Assign Ability' ],

			[ 'ability_module_id' => '4', 'category' => 'ViewAny', 'name' => 'ViewAnyUser', 'label' => 'User View List' ],
			[ 'ability_module_id' => '4', 'category' => 'Create', 'name' => 'CreateUser', 'label' => 'User Create' ],
			[ 'ability_module_id' => '4', 'category' => 'Update', 'name' => 'UpdateUser', 'label' => 'User Update' ],
			[ 'ability_module_id' => '4', 'category' => 'Other', 'name' => 'UpdateUserPassword', 'label' => 'User Update Password' ],
			[ 'ability_module_id' => '4', 'category' => 'Delete', 'name' => 'DeleteUser', 'label' => 'User Delete' ],
			[ 'ability_module_id' => '4', 'category' => 'Other', 'name' => 'AssignUserRole', 'label' => 'User Assign Role' ],
			[ 'ability_module_id' => '4', 'category' => 'Other', 'name' => 'AssignUserAbility', 'label' => 'User Assign Ability' ],

			[ 'ability_module_id' => '5', 'category' => 'ViewAny', 'name' => 'ViewAnyCustomer', 'label' => 'Customer View List' ],
			[ 'ability_module_id' => '5', 'category' => 'Create', 'name' => 'CreateCustomer', 'label' => 'Customer Create' ],
			[ 'ability_module_id' => '5', 'category' => 'Update', 'name' => 'UpdateCustomer', 'label' => 'Customer Update' ],
			[ 'ability_module_id' => '5', 'category' => 'Delete', 'name' => 'DeleteCustomer', 'label' => 'Customer Delete' ],

			[ 'ability_module_id' => '6', 'category' => 'ViewAny', 'name' => 'ViewAnySupplier', 'label' => 'Supplier View List' ],
			[ 'ability_module_id' => '6', 'category' => 'Create', 'name' => 'CreateSupplier', 'label' => 'Supplier Create' ],
			[ 'ability_module_id' => '6', 'category' => 'Update', 'name' => 'UpdateSupplier', 'label' => 'Supplier Update' ],
			[ 'ability_module_id' => '6', 'category' => 'Delete', 'name' => 'DeleteSupplier', 'label' => 'Supplier Delete' ],

			[ 'ability_module_id' => '7', 'category' => 'ViewAny', 'name' => 'ViewAnyProduct', 'label' => 'Product View List' ],
			[ 'ability_module_id' => '7', 'category' => 'Create', 'name' => 'CreateProduct', 'label' => 'Product Create' ],
			[ 'ability_module_id' => '7', 'category' => 'Update', 'name' => 'UpdateProduct', 'label' => 'Product Update' ],
			[ 'ability_module_id' => '7', 'category' => 'Delete', 'name' => 'DeleteProduct', 'label' => 'Product Delete' ],

			[ 'ability_module_id' => '8', 'category' => 'ViewAny', 'name' => 'ViewAnyProductCategory', 'label' => 'ProductCategory View List' ],
			[ 'ability_module_id' => '8', 'category' => 'Create', 'name' => 'CreateProductCategory', 'label' => 'ProductCategory Create' ],
			[ 'ability_module_id' => '8', 'category' => 'Update', 'name' => 'UpdateProductCategory', 'label' => 'ProductCategory Update' ],
			[ 'ability_module_id' => '8', 'category' => 'Delete', 'name' => 'DeleteProductCategory', 'label' => 'ProductCategory Delete' ],

			[ 'ability_module_id' => '9', 'category' => 'ViewAny', 'name' => 'ViewAnyExpense', 'label' => 'Expense View List' ],
			[ 'ability_module_id' => '9', 'category' => 'Create', 'name' => 'CreateExpense', 'label' => 'Expense Create' ],
			[ 'ability_module_id' => '9', 'category' => 'Update', 'name' => 'UpdateExpense', 'label' => 'Expense Update' ],
			[ 'ability_module_id' => '9', 'category' => 'Delete', 'name' => 'DeleteExpense', 'label' => 'Expense Delete' ],

			[ 'ability_module_id' => '10', 'category' => 'ViewAny', 'name' => 'ViewAnyOtherIncome', 'label' => 'OtherIncome View List' ],
			[ 'ability_module_id' => '10', 'category' => 'Create', 'name' => 'CreateOtherIncome', 'label' => 'OtherIncome Create' ],
			[ 'ability_module_id' => '10', 'category' => 'Update', 'name' => 'UpdateOtherIncome', 'label' => 'OtherIncome Update' ],
			[ 'ability_module_id' => '10', 'category' => 'Delete', 'name' => 'DeleteOtherIncome', 'label' => 'OtherIncome Delete' ],

			[ 'ability_module_id' => '11', 'category' => 'ViewAny', 'name' => 'ViewAnyStockIn', 'label' => 'StockIn View List' ],
			[ 'ability_module_id' => '11', 'category' => 'Create', 'name' => 'CreateStockIn', 'label' => 'StockIn Create' ],
			[ 'ability_module_id' => '11', 'category' => 'Update', 'name' => 'UpdateStockIn', 'label' => 'StockIn Update' ],
			[ 'ability_module_id' => '11', 'category' => 'Delete', 'name' => 'DeleteStockIn', 'label' => 'StockIn Delete' ],

			[ 'ability_module_id' => '12', 'category' => 'ViewAny', 'name' => 'ViewAnyStockOut', 'label' => 'StockOut View List' ],
			[ 'ability_module_id' => '12', 'category' => 'Create', 'name' => 'CreateStockOut', 'label' => 'StockOut Create' ],
			[ 'ability_module_id' => '12', 'category' => 'Update', 'name' => 'UpdateStockOut', 'label' => 'StockOut Update' ],
			[ 'ability_module_id' => '12', 'category' => 'Delete', 'name' => 'DeleteStockOut', 'label' => 'StockOut Delete' ],

			[ 'ability_module_id' => '13', 'category' => 'ViewAny', 'name' => 'ViewAnyStockAdjustment', 'label' => 'StockAdjustment View List' ],
			[ 'ability_module_id' => '13', 'category' => 'Create', 'name' => 'CreateStockAdjustment', 'label' => 'StockAdjustment Create' ],
			[ 'ability_module_id' => '13', 'category' => 'Update', 'name' => 'UpdateStockAdjustment', 'label' => 'StockAdjustment Update' ],
			[ 'ability_module_id' => '13', 'category' => 'Delete', 'name' => 'DeleteStockAdjustment', 'label' => 'StockAdjustment Delete' ],

			[ 'ability_module_id' => '14', 'category' => 'ViewAny', 'name' => 'ViewAnyStockBalance', 'label' => 'StockBalance View List' ],

			[ 'ability_module_id' => '15', 'category' => 'ViewAny', 'name' => 'ViewReportSale', 'label' => 'ReportSale View List' ],
			[ 'ability_module_id' => '16', 'category' => 'ViewAny', 'name' => 'ViewReportRevenue', 'label' => 'ReportRevenue View List' ],
			[ 'ability_module_id' => '17', 'category' => 'ViewAny', 'name' => 'ViewReportExpense', 'label' => 'ReportExpense View List' ],
			[ 'ability_module_id' => '18', 'category' => 'ViewAny', 'name' => 'ViewReportProfitLoss', 'label' => 'ReportProfitLoss View List' ],
			[ 'ability_module_id' => '19', 'category' => 'ViewAny', 'name' => 'ViewReportInventory', 'label' => 'ReportInventory View List' ],

		]);
	}
}
