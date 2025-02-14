<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insurance Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-md">
        <h1 class="text-2xl font-bold text-center mb-4">Insurance Management</h1>
        
        <div id="insurances" class="space-y-4"></div>
        
        <h2 class="text-xl font-semibold mt-6">Add New Insurance</h2>
        <form id="insuranceForm" class="mt-4 space-y-2">
            <input type="number" id="vehicle_id" placeholder="Vehicle ID" required class="w-full p-2 border rounded">
            <input type="text" id="insurance_company" placeholder="Insurance Company" required class="w-full p-2 border rounded">
            <input type="date" id="expiration_date" required class="w-full p-2 border rounded">
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Add Insurance</button>
        </form>
    </div>

    <script>
        async function loadInsurances() {
            const response = await fetch('/api/insurances');
            const data = await response.json();
            const container = document.getElementById('insurances');
            container.innerHTML = '';
            data.forEach(insurance => {
                container.innerHTML += `
                    <div class="bg-white p-4 rounded-lg shadow flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold">${insurance.insurance_company}</h3>
                            <p class="text-gray-600">Vehicle ID: ${insurance.vehicle_id}</p>
                            <p class="text-gray-600">Expiration Date: ${insurance.expiration_date}</p>
                        </div>
                        <div>
                            <button onclick="editInsurance(${insurance.id}, '${insurance.vehicle_id}', '${insurance.insurance_company}', '${insurance.expiration_date}')" 
                                class="text-yellow-500 hover:text-yellow-600 mr-2">Edit</button>
                            <button onclick="deleteInsurance(${insurance.id})" class="text-red-500 hover:text-red-600">Delete</button>
                        </div>
                    </div>`;
            });
        }
        
        document.getElementById('insuranceForm').addEventListener('submit', async function (e) {
            e.preventDefault();
            const insurance = {
                vehicle_id: document.getElementById('vehicle_id').value,
                insurance_company: document.getElementById('insurance_company').value,
                expiration_date: document.getElementById('expiration_date').value,
            };
            await fetch('/api/insurances', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(insurance)
            });
            this.reset();
            loadInsurances();
        });

        async function deleteInsurance(id) {
            await fetch(`/api/insurances/${id}`, { method: 'DELETE' });
            loadInsurances();
        }

        function editInsurance(id, vehicle_id, insurance_company, expiration_date) {
            document.getElementById('vehicle_id').value = vehicle_id;
            document.getElementById('insurance_company').value = insurance_company;
            document.getElementById('expiration_date').value = expiration_date;
            
            document.getElementById('insuranceForm').onsubmit = async function (e) {
                e.preventDefault();
                const updatedInsurance = {
                    vehicle_id: document.getElementById('vehicle_id').value,
                    insurance_company: document.getElementById('insurance_company').value,
                    expiration_date: document.getElementById('expiration_date').value,
                };
                await fetch(`/api/insurances/${id}`, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(updatedInsurance)
                });
                this.reset();
                this.onsubmit = addInsurance;
                loadInsurances();
            };
        }

        loadInsurances();
    </script>
</body>
</html>

