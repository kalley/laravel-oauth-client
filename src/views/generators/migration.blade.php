<?php echo "<?php\n"; ?>

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOauthClientSetupTables extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('social_sites', function($table) {
      $table->increments('id');
      $table->string('name');
    });

    Schema::create('user_social_sites', function($table) {
      $table->bigIncrements('id');
      $table->integer('user_id')->unsigned();
      $table->integer('social_site_id')->unsigned();
      // No length: http://stackoverflow.com/questions/4408945/what-is-the-length-of-the-access-token-in-facebook-oauth2#answer-16365828
      $table->string('access_token');
      $table->string('social_user_id');
      $table->timestamps();

      $table->foreign('user_id')->references('id')->on('{{ $table }}')
        ->onUpdate('cascade')->onDelete('cascade');
      $table->foreign('social_site_id')->references('id')->on('social_sites')
        ->onUpdate('cascade')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('user_social_sites');
    Schema::drop('social_sites');
  }

}
