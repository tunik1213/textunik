<?php

use App\Article;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToArticles extends Migration
{
    public function __construct()
    {
        DB::statement('SET SQL_MODE=\'ALLOW_INVALID_DATES\';');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        try {

            Schema::table('articles', function (Blueprint $table) {
                $table->string('slug')
                    ->nullable()
                    ->index();
            });

            // set slug for public articles
            DB::statement("update articles set slug = 'kak-kopirayteru-stat-effektivnee-i-vse-uspevat' where id = 48;");
            DB::statement("update articles set slug = 'kak-kopirayteru-pravilno-vystroit-obshchenie-s-klientom' where id = 34;");
            DB::statement("update articles set slug = 'kak-kopirayteru-s-pervogo-raza-ubedit-zakazchika-na-predoplatu' where id = 37;");
            DB::statement("update articles set slug = 'kopirayting-v-sele-ili-usloviya-dlja-kopirajtera' where id = 28;");
            DB::statement("update articles set slug = '10-kopirayterskikh-fishek-kak-napisat''-tekst' where id = 47;");
            DB::statement("update articles set slug = 'kritika-v-rabote-kopiraytera-kak-vosprinimat' where id = 35;");
            DB::statement("update articles set slug = 'seo-kak-vpisyvat-klyuchi-v-tekst-i-poluchat-udovolstvie' where id = 56;");
            DB::statement("update articles set slug = 'kak-napisat-seo-tekst-chtoby-on-ponravilsya-poiskovym-sistemam-rekomendacii' where id = 46;");
            DB::statement("update articles set slug = 'sindrom-samozvantsa-u-kopirajtera-kak-borot''sja' where id = 45;");
            DB::statement("update articles set slug = 'kak-napisat-lid-trebovanija-k-lidam-primery-lidov' where id = 42;");
            DB::statement("update articles set slug = 'kak-napisat-statyu-dlya-sayta-poshagovoe-rukovodstvo' where id = 40;");
            DB::statement("update articles set slug = 'dolgaya-doroga-v-kopirayting-ili-istoriya-pensionera-frilansera' where id = 60;");
            DB::statement("update articles set slug = 'pervye-shagi-novichka-v-kopiraytinge-lichnyj-opyt' where id = 52;");
            DB::statement("update articles set slug = 'minusy-v-budnyakh-kopiraytera-sovety-nachinajushhemu-kopirajteru' where id = 26;");
            DB::statement("update articles set slug = 'kak-stat-khoroshim-kopirayterom-11-fishek-iz-lichnogo-opyta' where id = 32;");
            DB::statement("update articles set slug = 'kak-napisat-statyu-s-chistogo-lista-rukovodstvo' where id = 50;");
            DB::statement("update articles set slug = 'plyusy-kopiraytinga-preimushhestva-professii-kopirajter' where id = 25;");
            DB::statement("update articles set slug = 'veb-rayting-i-kopirayting-razbiraemsya-s-terminologiey' where id = 21;");
            DB::statement("update articles set slug = 'kak-pisat-teksty-dlya-saytov-i-ne-otvlekat''sja-sovety' where id = 27;");
            DB::statement("update articles set slug = 'pervye-zakazy-kopirajtera-istorija-iz-lichnogo-opyta' where id = 23;");
            DB::statement("update articles set slug = 'kak-ya-stala-frilanserom-istorija-iz-lichnogo-opyta' where id = 22;");

        } catch (PDOException $ex) {
            $this->down();
            throw $ex;
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
