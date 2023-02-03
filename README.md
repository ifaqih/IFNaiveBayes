# Naive Bayes Classifier

Naive Bayes classifier (NBC) is a machine learning method that utilizes probability and statistical calculations proposed by British scientist Thomas Bayes, which predicts future probabilities based on past experience.

PHP Version: 8.0 or 8.1
|-

## Installation

### With Composer:

```ruby
composer require ifaqih/ifnaivebayes
```

## Use The Library

```ruby
use IFaqih\AIMethods\NaiveBayes;
```

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
    "attribute name"   =>  value,
    "attribute name"   =>  value,
    "attribute name"   =>  value
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
- Parameter data type: `array|object $data, int $type_training_data = 0, ?string $key_label = null`
- Return data type: `void`

### Prototype 1:

```ruby
$data = [
    [
        "attribute name"   =>  value,
        "attribute name"   =>  value,
        "attribute name"   =>  value,
        "label"            =>  value
    ]
];

$type_training_data = 0;
or
$type_training_data = NB_BY_ROWS;
```

### Prototype 2:

```ruby
$data = [
    "label" =>  [
        [
            "attribute name"   =>  value,
            "attribute name"   =>  value,
            "attribute name"   =>  value
        ]
    ]
];

$type_training_data = 1;
or
$type_training_data = NB_BY_GROUP_LABEL;
```

### Prototype 3:

Set training data based on number of attributes and number of labels.
If using this prototype does not require data input (in the set_data() method) and will skip the attribute calculation stage, because it is assumed to have performed attribute calculations manually.

```ruby
$data = [
    "label" =>  [
        "attributes"    =>  [
            "attribute name"   =>  number of attributes on the label,
            "attribute name"   =>  number of attributes on the label,
            "attribute name"   =>  number of attributes on the label
        ],
        "total"         =>  number of labels
    ]
];

$type_training_data = 1;
or
$type_training_data = NB_BY_NUMBER;
```

info:

- label: something that represents the group name
- attribute name: parameters to be calculated in the classification process
- "$key_label" parameter is not needed when using the second prototype

## Process Method

The method that will perform the classification calculation.

```ruby
class::process()
```

- Type: static
- Parameter data type: `?array $data = null, array|object|null $training_data = null, int $type_training_data = 0, ?string $key_label = null, bool $boolean_returned = true, bool $clear_after = false`
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

## Test Results

Number of training data = 100000

```ruby
Example Prototype Training Data 1:

array(5) {
  ["result"]=>
  string(2) "TI"
  ["point"]=>
  object(stdClass)(3) {
    ["TI"]=>
    float(0.0020101198329071602)
    ["TM"]=>
    float(0.00048783922881731547)
    ["TP"]=>
    float(0.0011221592061979964)
  }
  ["start_at"]=>
  float(1666072755.080761)
  ["end_at"]=>
  float(1666072755.145308)
  ["execution_time"]=>
  float(0.06454706192016602)
}


Example Prototype Training Data 2:

array(5) {
  ["result"]=>
  string(2) "TI"
  ["point"]=>
  object(stdClass)(3) {
    ["TI"]=>
    float(0.0020101198329071602)
    ["TM"]=>
    float(0.00048783922881731547)
    ["TP"]=>
    float(0.0011221592061979964)
  }
  ["start_at"]=>
  float(1666072755.27086)
  ["end_at"]=>
  float(1666072755.291312)
  ["execution_time"]=>
  float(0.020452022552490234)
}


Example Prototype Training Data 3:

array(5) {
  ["result"]=>
  string(2) "TI"
  ["point"]=>
  object(stdClass)(3) {
    ["TI"]=>
    float(0.0020101198329071602)
    ["TM"]=>
    float(0.00048783922881731547)
    ["TP"]=>
    float(0.0011221592061979964)
  }
  ["start_at"]=>
  float(1666072755.291341)
  ["end_at"]=>
  float(1666072755.29135)
  ["execution_time"]=>
  float(8.821487426757812E-6)
}
```
