<?php

namespace NTTData\Api\Service\Api;

class PokeApi{

    protected $apiService;
    protected $helper;
    protected $baseURL;
    protected $endpointAll;
	protected $message;
	protected $collection;
	protected $model;

    public function __construct(
        \NTTData\Api\Service\ApiService $apiService,
        \NTTData\Api\Helper\Data $helper,
		\NTTData\Api\Model\ResourceModel\Pokemon\CollectionFactory $collection,
		\NTTData\Api\Model\PokemonFactory $model
    ) {
        $this->apiService = $apiService;
        $this->helper = $helper;
        $this->baseURL = $this->helper->getBaseURL();
        $this->endpointAll = $this->helper->getEndpointAll();
		$this->collection = $collection;
		$this->model = $model;
    }

    public function getAll($params = ''){
        $pokemons = [];
		if(!$params) $params = $this->helper->getParams();

		$content = $this->apiService->getContent($this->baseURL, $this->endpointAll . '?' . $params);
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

	public function cron(){
		$offset = $this->collection->create()->getSize();
		$params = "limit=50&offset=$offset";
		$pokemonArr = $this->getAll($params);
		foreach($pokemonArr as $pokemon){
			$pokemon['api_id'] = $pokemon['id']; 
			$pokemon['id'] = null;
			$model = $this->model->create();
			$model->setData($pokemon);
			$model->save();
		}
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