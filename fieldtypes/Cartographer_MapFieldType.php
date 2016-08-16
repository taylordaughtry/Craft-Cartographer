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
        $settings = $this->getSettings()->attributes;

        $settings['apiKey'] = craft()->plugins->getPlugin('cartographer')->getSettings()->apiKey;
        $settings['height'] = $settings['height'] ?: '250';

        craft()->templates->includeCssResource('cartographer/leaflet/leaflet.css');
        craft()->templates->includeCssResource('cartographer/cartographer.css');
        craft()->templates->includeCss('.cartographer__map{height:' . $settings['height'] . 'px;}');

        craft()->templates->includeJsResource('cartographer/leaflet/leaflet.js');
        craft()->templates->includeJsResource('cartographer/cartographer.js');
        craft()->templates->includeJs("new Cartographer.init('" . json_encode($settings) . "');");

        return craft()->templates->render('cartographer/field/input', array(
            'name' => $name,
            'value' => $value,
            'settings' => $settings
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