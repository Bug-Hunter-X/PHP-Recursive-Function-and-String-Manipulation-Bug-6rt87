```php
function processData(array $data): array {
  foreach ($data as $key => $value) {
    if (is_array($value)) {
      $data[$key] = processData($value); // Recursive call
    } else if (is_string($value) && strpos($value, 'error') !== false) {
      // Handle error strings
      $data[$key] = str_replace('error', 'ERROR', $value); // Example fix
    }
  }
  return $data;
}

$data = [
  'field1' => 'This is an error',
  'field2' => [
    'subfield1' => 'Another error',
    'subfield2' => 123
  ],
  'field3' => 'No error here'
];

$processedData = processData($data);
print_r($processedData);
```