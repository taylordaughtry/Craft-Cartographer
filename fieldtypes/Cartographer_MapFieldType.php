<?php
namespace Craft;

class Cartographer_MapFieldType extends BaseFieldType
{
    public function getName()
    {
        return Craft::t('Map');
    }

    public function defineContentAttribute()
    {
        return array(AttributeType::Mixed, 'column' => ColumnType::Text);
    }

    public function getInputHtml($name, $value)
    {
        return craft()->templates->render('cartographer/field/input', array(
            'id' => craft()->templates->formatInputId($name),
            'name' => $name,
            'value' => $value,
            'settings' => $this->getSettings()
        ));
    }

    public function getSettingsHtml()
    {
        return craft()->templates->render('cartographer/field/settings', array(
            'settings' => $this->getSettings()
        ));
    }

    protected function defineSettings()
    {
        return array(
            'lat' => array(AttributeType::Mixed, 'min' => 0),
            'lng' => array(AttributeType::Mixed, 'min' => 0),
            'zoom' => array(AttributeType::Mixed, 'min' => 0),
            'height' => array(AttributeType::Mixed, 'min' => 200)
        );
    }
}