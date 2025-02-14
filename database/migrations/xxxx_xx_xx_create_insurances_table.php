public function up()
{
    Schema::create('insurances', function (Blueprint $table) {
        $table->id(); 
        $table->unsignedBigInteger('vehicle_id')->unique(); 
        $table->string('insurance_company'); 
        $table->date('expiration_date'); 
        $table->timestamps();
        
        $table->foreign('vehicle_id')->references('id')->on('vehicles');
    });
}
