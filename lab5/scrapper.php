<?php
    function findLinks($curlData) {
        
        $matchedArray = NULL;
        $matchedUnique = NULL;
        
        preg_match_all('/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/', $curlData, $matchedArray);
        
        $count = 0;
        foreach($matchedArray[0] as $match) {
            $isUnique = true;
            for($i = 0; $i < $count; $i++) {
                if($match === $matchedArray[0][$i]) {
                    $isUnique = false;
                    break;
                }
            }
        
            if($isUnique) $matchedUnique[] = $match;
            $count++;
        }
    
        return $matchedUnique;
    }
?>