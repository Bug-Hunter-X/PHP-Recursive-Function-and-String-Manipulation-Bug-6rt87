```php
function processData(array $data, array &$processed = []): array {
  foreach ($data as $key => $value) {
    if (is_array($value) && !in_array($value, $processed, true)) {
       $processed[] = $value; //Track processed arrays to avoid circular references
      $data[$key] = processData($value, $processed); // Recursive call
    } else if (is_string($value) && strpos($value, 'error') !== false) {
      $data[$key] = str_replace('error', 'ERROR', $value);
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