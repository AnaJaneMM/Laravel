<!-- resources/views/insurances.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insurance Management</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .insurance { margin-bottom: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
        .insurance h3 { margin: 0; }
        .insurance p { margin: 5px 0; }
    </style>
</head>
<body>
    <h1>Insurance Management</h1>
    <div id="insurances"></div>
    
    <h2>Add New Insurance</h2>
    <form id="insuranceForm">
        <input type="number" id="vehicle_id" placeholder="Vehicle ID" required>
        <input type="text" id="insurance_company" placeholder="Insurance Company" required>
        <input type="date" id="expiration_date" placeholder="Expiration Date" required>
        <button type="submit">Add Insurance</button>
    </form>

    <script>
        fetch('/api/insurances')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('insurances');
            data.forEach(insurance => {
                container.innerHTML += `
                    <div class="insurance" data-id="${insurance.id}">
                        <h3>${insurance.insurance_company}</h3>
                        <p>Vehicle ID: ${insurance.vehicle_id}</p>
                        <p>Expiration Date: ${insurance.expiration_date}</p>
                        <button onclick="deleteInsurance(${insurance.id})">Delete</button>
                    </div>
                `;
            });
        });

        document.getElementById('insuranceForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const vehicle_id = document.getElementById('vehicle_id').value;
            const insurance_company = document.getElementById('insurance_company').value;
            const expiration_date = document.getElementById('expiration_date').value;
            
            fetch('/api/insurances', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ vehicle_id, insurance_company, expiration_date })
            })
            .then(response => response.json())
            .then(insurance => {
                document.getElementById('insurances').innerHTML += `
                    <div class="insurance" data-id="${insurance.id}">
                        <h3>${insurance.insurance_company}</h3>
                        <p>Vehicle ID: ${insurance.vehicle_id}</p>
                        <p>Expiration Date: ${insurance.expiration_date}</p>
                        <button onclick="deleteInsurance(${insurance.id})">Delete</button>
                    </div>
                `;
                document.getElementById('insuranceForm').reset();
            });
        });

        function deleteInsurance(id) {
            fetch(`/api/insurances/${id}`, { method: 'DELETE' })
            .then(() => {
                document.querySelector(`.insurance[data-id="${id}"]`).remove();
            });
        }
    </script>
</body>
</html>
