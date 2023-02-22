# Entry Type Fields

This [Craft CMS](https://craftcms.com) plugin provides two field types, for selecting one or many entry types.

## Template Examples

### Entry Type field

Accessing an entry type field value in a template will return either the selected entry type, or `null` if no entry type was selected.

```twig
{% if entry.entryTypeField %}
    <p>The selected entry type is: {{ entry.entryTypeField.name }}</p>
{% else %}
    <p>No entry type was selected.</p>
{% endif %}
```

### Entry Types field

An entry types field's value is a [collection](https://laravel.com/docs/9.x/collections) of the selected entry types.

```twig
{% if not entry.entryTypesField.isEmpty() %}
    <p>Selected entry types:</p>
    <ul>
        {% for entryType in entry.entryTypesField.all() %}
            <p>{{ entryType.name }}</p>
        {% endfor %}
    </ul>
{% else %}
    <p>No entry types were selected.</p>
{% endif %}
```

## Installation

This plugin can be installed from the [Craft Plugin Store](https://plugins.craftcms.com/) or with [Composer](https://packagist.org/).

### Craft Plugin Store

Open your Craft project's control panel, navigate to the Plugin Store, search for Entry Type Fields and click Install.

### Composer

Open your terminal, navigate to your Craft project's root directory and run the following command:

```
composer require spicyweb/craft-entry-type-fields
```

Then open your project's control panel, navigate to Settings &rarr; Plugins, find Entry Type Fields and click Install.

## Requirements

Entry Type Fields 1.x requires Craft CMS 4.3.0 or any later Craft CMS 4 release.

---

*Created and maintained by [Spicy Web](https://spicyweb.com.au)*
