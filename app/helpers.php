<?php
    function rupiahFormat($number)
    {
        return 'Rp. ' . number_format($number, 0, ',', '.');
    }