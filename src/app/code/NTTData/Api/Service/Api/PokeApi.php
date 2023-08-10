<?php

namespace NTTData\Api\Service\Api;

class PokeApi{

    protected $apiService;
    protected $helper;
    protected $baseURL;
    protected $endpointAll;
	protected $message;

    public function __construct(
        \NTTData\Api\Service\ApiService $apiService,
        \NTTData\Api\Helper\Data $helper
    ) {
        $this->apiService = $apiService;
        $this->helper = $helper;
        $this->baseURL = $this->helper->getBaseURL();
        $this->endpointAll = $this->helper->getEndpointAll();
    }

    public function getAll(){
        $pokemons = [];
		$params = $this->helper->getParams();
		parse_str($params, $params);

		$content = $this->apiService->getContent($this->baseURL, $this->endpointAll, $params);
		$this->message = $this->apiService->getResponse()->getStatusCode()!=200 ? $this->apiService->getResponse()->getReasonPhrase() : '';

		if($content){
			try {
				$result = $content['results'];
				foreach($result as $res){
					$pokemon = $this->apiService->getContent($res['url']);
					$pokemons[] = $this->parsePokemon($pokemon);
				}
			} catch (\Throwable $th) {
				$this->message = 'Error api response';
			}
		}

		return $pokemons;
	}

	public function getMessage(){
		return $this->message;
	}

	public function parsePokemon($pokemon){
		$types = [];
		foreach($pokemon['types'] as $type){
			$types[] = $type['type']['name'];
		}

		$generation = $this->apiService->getContent($pokemon['species']['url'])['generation']['name'];

		$regions = [];
		$regionResponse = $this->apiService->getContent($pokemon['location_area_encounters']);
		foreach($regionResponse as $region){
			$regions[] = $region['location_area']['name'];
		}

		$pokemonData = array(
			"name" => $pokemon['name'],
			"id" => $pokemon['id'],
			"type" => implode(', ',$types),
			"generation" => $generation,
			"region" => implode(', ',$regions),
			"image" => $pokemon['sprites']['other']['official-artwork']['front_default']
		);

		return $pokemonData; 
	}
}