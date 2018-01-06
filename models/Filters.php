<?php
class Filters extends model {

	public function getFilters($filters) {
		$products = new Products();
		$colors = new Colors();
		$sizes = new Sizes();

		$array = array(
			'searchTerm' =>'',
			'colors' => array(),
			'sizes' => array(),
			'slider0'=>0,
			'slider1'=>0,
			'maxslider' => 1000,
			'stars' => array(
				'0' => 0,
				'1' => 0,
				'2' => 0,
				'3' => 0,
				'4' => 0,
				'5' => 0
				),
			'sale' => 0,
			'options' => array()
		);
		if (isset($filters['searchTerm'])) {
			$array['searchTerm'] = $filters['searchTerm'];
		}
		
		$array['colors'] = $colors->getList();
		$color_products = $products->getListOfColors($filters);
		$array['sizes'] = $sizes->getList();
		$size_products = $products->getListOfSizes($filters);

		//filtro de cores
		foreach($array['colors'] as $ckey => $citem) {

			$array['colors'][$ckey]['count'] = '0';

			foreach($color_products as $cproduct) {
				if($cproduct['id_color'] == $citem['id']) {
					$array['colors'][$ckey]['count'] = $cproduct['c'];
				}
			}

			if ($array['colors'][$ckey]['count'] == '0') {
				unset($array['colors'][$ckey]);
			}
		}

		//filtrando os tamanhos

		foreach($array['sizes'] as $skey => $sitem) {

			$array['sizes'][$skey]['count'] = '0';

			foreach($size_products as $sproduct) {
				if($sproduct['id_size'] == $sitem['id']) {
					$array['sizes'][$skey]['count'] = $sproduct['c'];
				}
			}

			if ($array['sizes'][$skey]['count'] == '0') {
				unset($array['sizes'][$skey]);
			}
		}

		//filtro de precos
		if (isset($filters['slider0'])) {
			$array['slider0'] = $filters['slider0'];
		}
		if (isset($filters['slider1'])) {
			$array['slider1'] = $filters['slider1'];
		}
		$array['maxslider'] = $products->getMaxPrice($filters);
		if ($array['slider1'] == 0) {
			$array['slider1'] = $array['maxslider'];
		}

		// filtro das estrelas
		$star_products = $products->getListOfStars($filters);
		foreach($array['stars'] as $skey => $sitem) {
			foreach($star_products as $sproduct) {
				if($sproduct['rating'] == $skey) {
					$array['stars'][$skey] = $sproduct['c'];
				}
			}
		}

		//filtro das promocoes
		$array['sale'] = $products->getSaleCount($filters);

		//filtro das opcoes	
		$array['options'] = $products->getAvailableOptions($filters);


		return $array;
	}

}