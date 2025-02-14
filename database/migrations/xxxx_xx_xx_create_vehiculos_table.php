public function up()
{
    Schema::create('vehiculos', function (Blueprint $table) {
        $table->id(); // ID único autoincremental
        $table->string('license_plate')->unique(); // Placa de vehículo única
        $table->string('brand'); // Marca del vehículo
        $table->string('model'); // Modelo del vehículo
        $table->integer('year'); // Año de fabricación
        $table->timestamps(); // Campos created_at y updated_at
    });
}
