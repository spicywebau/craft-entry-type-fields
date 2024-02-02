<?php

namespace spicyweb\entrytypefields\fields;

use Craft;
use craft\base\Field;
use craft\base\PreviewableFieldInterface;
use craft\helpers\Cp;
use craft\models\EntryType;

/**
 * Base class for the plugin's field types.
 *
 * @package spicyweb\entrytypefields\fields
 * @author Spicy Web <plugins@spicyweb.com.au>
 * @since 1.0.0
 */
abstract class BasePluginField extends Field implements PreviewableFieldInterface
{
    /**
     * @var string|string[] The entry types that are allowed to be used for this field.
     */
    public string|array $allowedEntryTypes = '*';

    /**
     * @inheritdoc
     */
    public static function icon(): string
    {
        return 'files';
    }

    /**
     * @inheritdoc
     */
    public function settingsAttributes(): array
    {
        $attributes = parent::settingsAttributes();
        $attributes[] = 'allowedEntryTypes';

        return $attributes;
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml(): ?string
    {
        return Cp::checkboxSelectFieldHtml([
            'label' => Craft::t('entry-type-fields', 'Allowed Entry Types'),
            'instructions' => Craft::t('entry-type-fields', 'Which entry types can be selected with this field.'),
            'id' => 'allowedEntryTypes',
            'name' => 'allowedEntryTypes',
            'options' => array_map(
                fn($entryType) => [
                    'label' => $entryType->name,
                    'value' => 'entryType:' . $entryType->uid,
                ],
                Craft::$app->getEntries()->getAllEntryTypes()
            ),
            'values' => $this->allowedEntryTypes,
            'showAllOption' => true,
        ]);
    }

    /**
     * Gets the allowed entry types for this plugin's field types.
     *
     * @return array
     */
    protected function getAllowedEntryTypes(): array
    {
        $options = [];

        foreach (Craft::$app->getEntries()->getAllEntryTypes() as $entryType) {
            $entryTypeSource = 'entryType:' . $entryType->uid;

            if (!is_array($this->allowedEntryTypes) || in_array($entryTypeSource, $this->allowedEntryTypes)) {
                $options[] = $entryType;
            }
        }

        return $options;
    }
}
