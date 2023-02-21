<?php

namespace spicyweb\entrytypefields;

use craft\base\Plugin as BasePlugin;
use craft\events\RegisterComponentTypesEvent;
use craft\services\Fields;
use spicyweb\entrytypefields\fields\EntryTypeField;
use spicyweb\entrytypefields\fields\EntryTypesField;
use yii\base\Event;

/**
 * Main Entry Type Fields plugin class.
 *
 * @package spicyweb\entrytypefields
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
