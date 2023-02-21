<?php

namespace spicyweb\entrytypefields\fields;

use Craft;
use craft\base\ElementInterface;
use craft\helpers\Cp;
use craft\helpers\Json as JsonHelper;
use craft\models\EntryType;

/**
 * Entry Type field type class.
 *
 * @package spicyweb\entrytypefields\fields
 * @author Spicy Web <plugins@spicyweb.com.au>
 * @since 1.0.0
 */
class EntryTypeField extends BasePluginField
{
    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('entry-type-fields', 'Entry Type');
    }

    /**
     * @inheritdoc
     */
    public function getInputHtml(mixed $value, ?ElementInterface $element = null): string
    {
        return Craft::$app->getView()->renderTemplate('_includes/forms/select', [
            'name' => $this->handle,
            'value' => $value?->id,
            'options' => array_merge([[
                'label' => '',
                'value' => null,
            ]], $this->getEntryTypesInputData()),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getTableAttributeHtml(mixed $value, ElementInterface $element): string
    {
        return $value instanceof EntryType ? $value->name : '';
    }

    /**
     * @inheritdoc
     */
    public function normalizeValue(mixed $value, ?ElementInterface $element = null): mixed
    {
        if ($value === null) {
            return null;
        }

        if (!is_array($value)) {
            $value = JsonHelper::decodeIfJson($value);
        }

        // Make sure we're only dealing with one entry type - if we have a multi-select value, take the first one
        if (is_array($value)) {
            $value = $value[0];
        }

        if ($value instanceof EntryType) {
            return $value;
        }

        return $value !== null ? Craft::$app->getSections()->getEntryTypeById($value) : null;
    }

    /**
     * @inheritdoc
     */
    public function serializeValue(mixed $value, ?ElementInterface $element = null): mixed
    {
        // Return the ID in an array, in case the field is converted to an entry types field in the future
        return $value !== null ? [$value->id] : null;
    }
}
