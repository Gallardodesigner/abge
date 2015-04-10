<?php namespace Alexanderzon\Hashids;

use Hashids\Hashids;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class HashidsServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Register the package namespace
		$this->package('alexanderzon/laravel-hashids');

		// Add 'Assets' facade alias
		AliasLoader::getInstance()->alias('Hashids', 'Alexanderzon\Hashids\Facade');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// Bind 'hashids' shared component to the IoC container
		$this->app->singleton('hashids', function($app)
		{
			// Read settings from config file
			$config = $app->config->get('laravel-hashids::config', array());

           	return new Hashids($config['salt'], $config['length'], $config['alphabet']);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
