<?php

// Prevent redeclaration error (optional safety)
if (! function_exists('get_islamic_casts')) {
    /**
     * Returns an array of common Islamic casts/sects.
     *
     * @return array
     */
    function get_islamic_casts()
    {
        return [
            'Sunni',
            'Shia',
            'Deobandi',
            'Barelvi',
            'Ahl-e-Hadith',
            'Ismaili',
            'Bohra (Dawoodi Bohra)',
            'Wahhabi',
            'Sufi',
            'Ahmadiyya',
            'Salafi',
            'Zikri',
            'Tablighi Jamaat',
            'Khoja',
            'Hanafi',
            'Shafi’i',
            'Maliki',
            'Hanbali',
            'Other'
        ];
    }
}
