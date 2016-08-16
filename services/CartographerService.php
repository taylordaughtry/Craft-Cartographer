<?php
namespace Craft;

class CartographerService extends BaseApplicationComponent
{
	public function buildMap($value)
	{
		$model = Cartographer_MapModel::populateModel($value);

		return $model;
	}
}