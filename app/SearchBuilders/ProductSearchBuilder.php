<?php
namespace App\SearchBuilders;

use App\Models\Category;

class ProductSearchBuilder{

	protected $params = [
		'index' => 'products',
		'type' => '_doc',
		'body' => [
			'query' => [
				'bool' => [
					'filter' => [],
					'must' => [],
				],
			],
		],
	];

	public function paginate($size, $page)
	{	
		$this->params['body']['from'] = ($page - 1) * $size;
		$this->params['body']['size'] = $size;

		return $this;
	}

	public function onSale()
	{
		$this->params['body']['query']['bool']['filter'][] = ['term' => ['on_sale' => true]];

		return $this;
	}

	public function category(Category $category)
	{
		if($category->is_directory){
			$this->params['body']['query']['bool']['filter'][] = ['prefix' => ['category_path' => $category->path . $category->id . '-']];
		} else {
			$this->params['body']['query']['bool']['filter'][] = ['term' => ['category_id' => $category->id]];
		}

		return $this;
	}

	// 添加搜索词
    public function keywords($keywords)
    {
        // 如果参数不是数组则转为数组
        $keywords = is_array($keywords) ? $keywords : [$keywords];
        foreach ($keywords as $keyword) {
            $this->params['body']['query']['bool']['must'][] = [
                'multi_match' => [
                    'query'  => $keyword,
                    'fields' => [
                        'title^3',
                        'long_title^2',
                        'category^2',
                        'description',
                        'skus_title',
                        'skus_description',
                        'properties_value',
                    ],
                ],
            ];
        }

        return $this;
    }

	public function aggregateProperties()
	{
		$this->params['body']['aggs'] = [
			// 聚合的名称,可以是其他字符串
			'properties' => [
				// 由于我们要聚合的属性是在 nested 类型字段下的属性，需要在外面套一层 nested 聚合查询
				'nested' => [
					// 代表我们要查询的 nested 字段名为 properties
					'path' => 'properties',
				],
				'aggs' => [
					// 聚合的名称
					'properties' => [
						// terms 聚合，用于聚合相同的值
						'terms' => [
							// 我们要聚合的字段名
							'field' => 'properties.name',
						],
						'aggs' => [
							'value' => [
								// terms 聚合，用于聚合相同的值
								'terms' => [
									'field' => 'properties.value'
								],
							],
						],
					],
				],
			],
		];

		return $this;
	}

	public function propertyFilter($name, $value, $type = 'filter')
	{	
		 // 将原来的 filter 改成 $type
        $this->params['body']['query']['bool'][$type][] = [
            'nested' => [
                'path'  => 'properties',
                'query' => [
                    ['term' => ['properties.search_value' => $name.':'.$value]],
                ],
            ],
        ];
	}

	public function minShouldMatch($count)
	{
		$this->params['body']['query']['bool']['minimum_should_match'] = (int)$count;
	}
	
	public function orderBy($field, $direction)
	{
		if(!isset($this->params['body']['sort'])){
			$this->params['body']['sort'] = [];
		}
		$this->params['body']['sort'][] = [$field => $direction];

		return $this;
	}

	public function getParams()
	{
		return $this->params;
	}
}