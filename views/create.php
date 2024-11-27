<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Create User</title>
</head>
<body>
    <div class="form-container">
        <h1>Create User</h1>
        <form id="userForm" action="index.php?action=save" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="country">Country:</label>
            <select id="country" name="country" required>
                <option value="">Select Country</option>
                <?php foreach ($countries as $country): ?>
                    <!-- <option value="<?= $country['iso2'] ?>"><?= $country['name'] ?></option> -->
                    <option value="<?= $country['iso2'] ?>"><?= $country['name'] ?></option>
                <?php endforeach; ?>
            </select>

            <label for="state">State:</label>
            <select id="state" name="state" required></select>

            <label for="city">City:</label>
            <select id="city" name="city" required></select>

            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const countrySelect = document.getElementById('country');
        const stateSelect = document.getElementById('state');
        const citySelect = document.getElementById('city');

        // Fetch states when a country is selected
        countrySelect.addEventListener('change', function() {
            const countryCode = this.value;
            stateSelect.innerHTML = '';
            citySelect.innerHTML = '';

            fetch(`https://api.countrystatecity.in/v1/countries/${countryCode}/states`, {
                headers: {
                    'X-CSCAPI-KEY': 'NHhvOEcyWk50N2Vna3VFTE00bFp3MjFKR0ZEOUhkZlg4RTk1MlJlaA=='
                }
            })
            .then(response => response.json())
            .then(data => {
                data.forEach(state => {
                    const option = document.createElement('option');
                    option.value = state.iso2;
                    option.textContent = state.name;
                    stateSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error loading states:', error));
        });

        // Fetch cities when a state is selected
        stateSelect.addEventListener('change', function() {
            const countryCode = countrySelect.value;
            const stateCode = this.value;
            citySelect.innerHTML = '';

            fetch(`https://api.countrystatecity.in/v1/countries/${countryCode}/states/${stateCode}/cities`, {
                headers: {
                    'X-CSCAPI-KEY': 'NHhvOEcyWk50N2Vna3VFTE00bFp3MjFKR0ZEOUhkZlg4RTk1MlJlaA=='
                }
            })
            .then(response => response.json())
            .then(data => {
                data.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.name;
                    option.textContent = city.name;
                    citySelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error loading cities:', error));
        });
    });
    </script>
</body>
</html>


