# Naive Bayes Classifier

Naive Bayes classifier (NBC) is a machine learning method that utilizes probability and statistical calculations proposed by British scientist Thomas Bayes, which predicts future probabilities based on past experience.

PHP Version: 8.0 or 8.1
|-

## Set Data Method

Method to set the data to be processed.

```ruby
class::set_data()
```

- Type: static
- Parameter data type: `array $data`
- Return data type: `void`

### Prototype:

```ruby
$data = [
    "attribute 1"   =>  value 1,
    "attribute 2"   =>  value 2,
    "attribute 3"   =>  value 3
]
```

info:

- label: something that represents the group name
- attribute: parameters to be calculated in the classification process

## Set Training Data Method

A method for organizing past classification data that will be used as the basis for future classifications.

```ruby
class::set_training_data()
```

- Type: static
- Parameter data type: `array|object $data, string $key_label = 'label'`
- Return data type: `void`

### Prototype 1:

```ruby
$data = [
    [
        "attribute 1"   =>  value,
        "attribute 2"   =>  value,
        "attribute 3"   =>  value,
        "label"         =>  value
    ]
]
```

### Prototype 2:

```ruby
$data = [
    "label" =>  [
        [
            "attribute 1"   =>  value,
            "attribute 2"   =>  value,
            "attribute 3"   =>  value
        ]
    ]
]
```

info:

- label: something that represents the group name
- attribute: parameters to be calculated in the classification process
- "$key_label" parameter is not needed when using the second prototype

## Process Method

The method that will perform the classification calculation.

```ruby
class::process()
```

- Type: static
- Parameter data type: `?array $data = null, array|object|null $training_data = null, ?string $key_label = null, bool $boolean_returned = true, bool $clear_after = false`
- Return data type: `string|bool|null`

info:
do not include parameters if already set data using 'set' method, otherwise this parameter data will overwrite data which have been set using 'set' method

## Get Result Method

Method to get the result of the classification process.

```ruby
class::get_result()
```

- Type: static
- Parameter data type: not needed
- Return data type: `string|int|float|null`

## Get Result Point Method

Method to get the points result from the classification process.

```ruby
class::get_result_point()
```

- Type: static
- Parameter data type: `?string $label = null`
- Return data type: `object|float|int|null`

info:
parameter in this method is used to get the calculation result points which refers to the requested label and will be returned in float data type, if parameter is not filled or contains null it will return all calculation result points in object data type

## Clear Method

This method will delete all data stored statically on the class.

```ruby
class::clear()
```

- Type: static
- Parameter data type: not needed
- Return data type: `void`
