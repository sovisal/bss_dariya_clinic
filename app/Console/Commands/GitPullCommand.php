<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GitPullCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'git:pull';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Pulling Project from git repository.';

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
		if (!empty(env('GIT_USR')) && !empty(env('GIT_TOKEN')) && !empty(env('GIT_PATH')) && InternetIsConnected()) {
			$this->info(shell_exec('git pull https://' . env('GIT_USR') . ':' . env('GIT_TOKEN') . '@' . env('GIT_PATH')));
		}else{
			if (InternetIsConnected()) {
				$this->info('Please check your network and retry!');
			}else{
				$this->info('Git User is invalid!');
			}
		}
		
	}
}
