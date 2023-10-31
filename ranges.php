<?php
 
function groupConsecutiveNumbers($input) {
    $numbers = explode(' ', $input); // Split the input string into an array of numbers
    $result = array(); // Initialize an array to store the grouped ranges

    if (count($numbers) > 0) {
        $start = $numbers[0]; // Initialize the start of the current range
        $end = $numbers[0];   // Initialize the end of the current range

        for ($i = 1; $i < count($numbers); $i++) {
            if ($numbers[$i] == $end + 1) {
                $end = $numbers[$i]; // Extend the current range
            } else {
                if ($start == $end) {
                    $result[] = $start; // Non-consecutive number
                } else {
                    $result[] = $start . '-' . $end; // Consecutive range
                }

                $start = $end = $numbers[$i]; // Start a new range
            }
        }

        // Add the last range to the result array
        if ($start == $end) {
            $result[] = $start;
        } else {
            $result[] = $start . '-' . $end;
        }
    }

    return implode(', ', $result); // Join the ranges with commas
}

// Test the function with the provided example
$input = "1 2 3 5 6 8";
$output = groupConsecutiveNumbers($input);
echo $output; // Output: "1-3, 5-6, 8"

?>