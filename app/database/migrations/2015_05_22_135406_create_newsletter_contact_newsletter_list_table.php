<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewsletterContactNewsletterListTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('newsletter_contact_newsletter_list', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('newsletter_contact_id')->unsigned()->index();
			$table->foreign('newsletter_contact_id')->references('id')->on('newsletter_contacts')->onDelete('cascade');
			$table->integer('newsletter_list_id')->unsigned()->index();
			$table->foreign('newsletter_list_id')->references('id')->on('newsletter_lists')->onDelete('cascade');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('newsletter_contact_newsletter_list');
	}

}
