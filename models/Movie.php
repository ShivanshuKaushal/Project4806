<?php
class Movie {
    private $apiUrl;
    private $apiKey;

    public function __construct($apiUrl, $apiKey) {
        $this->apiUrl = $apiUrl;
        $this->apiKey = $apiKey;
    }

    public function getMovie($title) {
        $url = $this->apiUrl . '?apikey=' . $this->apiKey . '&t=' . urlencode($title);
        $response = @file_get_contents($url);
        if ($response === FALSE) {
            return null;
        }
        return json_decode($response, true);
    }
}
?>
