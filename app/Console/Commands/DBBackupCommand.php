<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class DBBackupCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'db:backup';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Run Database Backup';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle()
	{
		// If you get error: 'mysqldump' is not recognized as an internal or external command, operable program or batch file
		// Then you need to add C:\xampp\mysql\bin\ to your Eviroment Variable on your windows
		$host = Config::get('database.connections.mysql.host');
		$username = Config::get('database.connections.mysql.username');
		$password = Config::get('database.connections.mysql.password');
		$dbname = Config::get('database.connections.mysql.database');
		$filename = $dbname .'_'. date('Y-m-d', time()) .'.sql';
		$path = storage_path('db_backup/'. $filename);
		exec('mysqldump --user='.$username.' --password='.$password.' --host='.$host. ' '.$dbname. ' > ' . $path);
		$this->info('Your backup is being saved to the root directory :' . $filename);
	}
}
