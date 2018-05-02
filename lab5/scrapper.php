<?php
    function findLinks($curlData) {
        // Initialize empty arrays (NULL)
        $matchedArray = NULL;
        $matchedUnique = NULL;
        
        // Match all valid urls, output to $matchedArray
        preg_match_all('/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/', $curlData, $matchedArray);
        
        // Check for duplicate urls
        $count = 0;
        foreach($matchedArray[0] as $match) {
            $isUnique = true; // Assume link is unique
            for($i = 0; $i < $count; $i++) { // Check every previous link in unfiltered array
                if($match === $matchedArray[0][$i]) {
                    $isUnique = false; // Revoke uniqueness status
                    break; // Break to avoid extra processing
                }
            }
        
            if($isUnique) $matchedUnique[] = $match; // Push to filtered array if still unique
            $count++; // Increase processed count for unfiltered array
        }
    
        return $matchedUnique; // Return list of unique urls
    }
?>