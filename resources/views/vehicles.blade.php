<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-md">
        <h1 class="text-2xl font-bold text-center mb-4">Vehicle Management</h1>
        
        <div id="vehicles" class="space-y-4"></div>
        
        <h2 class="text-xl font-semibold mt-6">Add New Vehicle</h2>
        <form id="vehicleForm" class="mt-4 space-y-2">
            <input type="text" id="license_plate" placeholder="License Plate" required class="w-full p-2 border rounded">
            <input type="text" id="brand" placeholder="Brand" required class="w-full p-2 border rounded">
            <input type="text" id="model" placeholder="Model" required class="w-full p-2 border rounded">
            <input type="number" id="year" placeholder="Year" required class="w-full p-2 border rounded">
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Add Vehicle</button>
        </form>
    </div>

    <script>
        async function loadVehicles() {
            const response = await fetch('/api/vehicles');
            const data = await response.json();
            const container = document.getElementById('vehicles');
            container.innerHTML = '';
            data.forEach(vehicle => {
                container.innerHTML += `
                    <div class="bg-white p-4 rounded-lg shadow flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold">${vehicle.brand} ${vehicle.model} (${vehicle.year})</h3>
                            <p class="text-gray-600">License Plate: ${vehicle.license_plate}</p>
                        </div>
                        <div>
                            <button onclick="editVehicle(${vehicle.id}, '${vehicle.license_plate}', '${vehicle.brand}', '${vehicle.model}', ${vehicle.year})" 
                                class="text-yellow-500 hover:text-yellow-600 mr-2">Edit</button>
                            <button onclick="deleteVehicle(${vehicle.id})" class="text-red-500 hover:text-red-600">Delete</button>
                        </div>
                    </div>`;
            });
        }
        
        document.getElementById('vehicleForm').addEventListener('submit', async function (e) {
            e.preventDefault();
            const vehicle = {
                license_plate: document.getElementById('license_plate').value,
                brand: document.getElementById('brand').value,
                model: document.getElementById('model').value,
                year: document.getElementById('year').value,
            };
            await fetch('/api/vehicles', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(vehicle)
            });
            this.reset();
            loadVehicles();
        });

        async function deleteVehicle(id) {
            await fetch(`/api/vehicles/${id}`, { method: 'DELETE' });
            loadVehicles();
        }

        function editVehicle(id, license_plate, brand, model, year) {
            document.getElementById('license_plate').value = license_plate;
            document.getElementById('brand').value = brand;
            document.getElementById('model').value = model;
            document.getElementById('year').value = year;
            
            document.getElementById('vehicleForm').onsubmit = async function (e) {
                e.preventDefault();
                const updatedVehicle = {
                    license_plate: document.getElementById('license_plate').value,
                    brand: document.getElementById('brand').value,
                    model: document.getElementById('model').value,
                    year: document.getElementById('year').value,
                };
                await fetch(`/api/vehicles/${id}`, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(updatedVehicle)
                });
                this.reset();
                this.onsubmit = addVehicle; 
                loadVehicles();
            };
        }

        loadVehicles();
    </script>
</body>
</html>
