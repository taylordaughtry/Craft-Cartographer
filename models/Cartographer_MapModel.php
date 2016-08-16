<?php
namespace Craft;

class Cartographer_MapModel extends BaseModel
{
	public function map()
	{
		$html = '<div class="works"><p>asdf</p></div>';

		return TemplateHelper::getRaw($html);
	}

	protected function defineAttributes()
	{
		return array(
			'lat' => AttributeType::Number,
			'lng' => AttributeType::Number,
			'zoom' => AttributeType::Number,
			'address' => AttributeType::Mixed,
			'parts' => AttributeType::Mixed
		);
	}

}