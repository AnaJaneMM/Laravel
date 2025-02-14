public function up()
{
    Schema::create('vehicles', function (Blueprint $table) {
        $table->id(); 
        $table->string('license_plate')->unique(); 
        $table->string('brand'); 
        $table->string('model'); 
        $table->integer('year'); 
        $table->timestamps();
    });
}
