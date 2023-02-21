<?php

namespace spicyweb\entrytypefields\fields;

use Craft;
use craft\base\ElementInterface;
use craft\helpers\Cp;
use craft\helpers\Json as JsonHelper;
use craft\models\EntryType;
use spicyweb\entrytypefields\collections\EntryTypesCollection;

/**
 * Entry Types field type class.
 *
 * @package spicyweb\entrytypefields\fields
 * @author Spicy Web <plugins@spicyweb.com.au>
 * @since 1.0.0
 */
class EntryTypesField extends BasePluginField
{
    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('entry-type-fields', 'Entry Types');
    }

    /**
     * @inheritdoc
     */
    public function getInputHtml(mixed $value, ?ElementInterface $element = null): string
    {
        return Craft::$app->getView()->renderTemplate('_includes/forms/multiselect', [
            'name' => $this->handle,
            'values' => $value?->ids() ?? [],
            'options' => $this->getEntryTypesInputData(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getTableAttributeHtml(mixed $value, ElementInterface $element): string
    {
        if (!$value instanceof EntryTypesCollection) {
            return '';
        }

        return implode(
            $value->map(fn($entryType) => $entryType->name),
            '; '
        );
    }

    /**
     * @inheritdoc
     */
    public function normalizeValue(mixed $value, ?ElementInterface $element = null): mixed
    {
        if ($value instanceof EntryTypesCollection) {
            return $value;
        }

        if (!is_array($value)) {
            $value = JsonHelper::decodeIfJson($value);
        }

        if (empty($value)) {
            return EntryTypesCollection::make([]);
        }

        $fieldEntryTypes = array_filter(
            Craft::$app->getSections()->getAllEntryTypes(),
            fn($entryType) => in_array($entryType->id, $value)
        );
        $fieldEntryTypes = array_values($fieldEntryTypes);

        return EntryTypesCollection::make($fieldEntryTypes);
    }

    /**
     * @inheritdoc
     */
    public function serializeValue(mixed $value, ?ElementInterface $element = null): mixed
    {
        return $value?->ids();
    }
}
