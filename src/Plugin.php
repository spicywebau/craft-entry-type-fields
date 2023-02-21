<?php

namespace spicyweb\entrytypesfield;

use craft\base\Plugin as BasePlugin;
use craft\events\RegisterComponentTypesEvent;
use craft\services\Fields;
use spicyweb\entrytypesfield\fields\EntryTypeField;
use spicyweb\entrytypesfield\fields\EntryTypesField;
use yii\base\Event;

/**
 * Main Entry Types Field plugin class.
 *
 * @package spicyweb\entrytypesfield
 * @author Spicy Web <plugins@spicyweb.com.au>
 * @since 1.0.0
 */
class Plugin extends BasePlugin
{
    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();

        Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function(RegisterComponentTypesEvent $event) {
                $event->types[] = EntryTypeField::class;
                $event->types[] = EntryTypesField::class;
            }
        );
    }
}
