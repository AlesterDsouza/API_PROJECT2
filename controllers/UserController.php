<?php

class UserController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function fetchCountries() {
        $url = "https://api.countrystatecity.in/v1/countries";
        $headers = [
            'X-CSCAPI-KEY: NHhvOEcyWk50N2Vna3VFTE00bFp3MjFKR0ZEOUhkZlg4RTk1MlJlaA=='
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function create() {
        $countries = $this->fetchCountries();
        include_once "./views/create.php";
    }

    public function save() {
        if ($_POST) {
            $name = $_POST['name'];
            $country = $_POST['country'];
            $state = $_POST['state'];
            $city = $_POST['city'];

            $this->model->saveUser($name, $country, $state, $city);

            echo "<script>alert('User successfully saved!'); window.location.href='index.php';</script>";
        }
    }
}


?>


