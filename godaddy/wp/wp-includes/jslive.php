$length = ob_get_length();
$last_modified = date ("F d Y H:i:s", getlastmod());
header("Content-Length: $length");
header("Last-Modified: $last_modified GMT time");

