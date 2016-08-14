<?php
namespace Craft;

class CartographerPlugin extends BasePlugin
{
	private $name = 'Cartographer';
	private $version = '0.1.0';
	private $schemaVersion = '0.1.0';
	private $description = 'Geolocation, maps, markers, and more.';
	private $developer = 'Taylor Daughtry';
	private $developerUrl = 'https://github.com/taylordaughtry';
	private $docUrl = 'https://github.com/taylordaughtry/cartographer';
	private $feedUrl = '';

	public function getName()
	{
		return $this->name;
	}

	public function getVersion()
	{
		return $this->version;
	}

	public function getSchemaVersion()
	{
		return $this->schemaVersion;
	}

	public function getDescription()
	{
		return Craft::t($this->description);
	}

	public function getDeveloper()
	{
		return $this->developer;
	}

	public function getDeveloperUrl()
	{
		return $this->developerUrl;
	}

	public function getDocumentationUrl()
	{
		return $this->docUrl;
	}

	public function getReleaseFeedUrl()
	{
		return $this->feedUrl;
	}

	public function getSettingsHtml()
	{
		return craft()->templates->render('cartographer/plugin/settings', array(
			'settings' => $this->getSettings()
		));
	}

	protected function defineSettings()
	{
		return array(
			'apiKey' => AttributeType::String
		);
	}
}