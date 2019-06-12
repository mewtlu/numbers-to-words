<?php namespace App;

class Generator {
    const digits = [
        0 => 'zero',
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
    ];

    const illogicals = [
        10 => 'ten',
        11 => 'eleven',
        12 => 'twelve',
        20 => 'twenty',
    ];

    const prefixes = [
        3 => 'thir',
        5 => 'fif',
        8 => 'eigh',
    ];

    function number2words($intNumber)
    {
        $strNumber = strval($intNumber);
        $arrNumber = str_split($strNumber);
        $strWordNumber = '';

        if ($this->getIllogical($intNumber)) {
            return $this->getIllogical($intNumber);
        } else if (0 <= $intNumber && 10 > $intNumber) {
            return $this->getDigit($intNumber);
        } else {
            $arrComponents = $this->splitToComponents($intNumber);
            $arrComponentWords = [];

            foreach ($arrComponents as $strComponent) {
                $intComponent = intval($strComponent);
                $strComponent = strval($intComponent);

                if ($this->getIllogical($intComponent)) { // check manually set
                    $arrComponentWords[$strComponent] = $this->getIllogical($intComponent);
                } else if ($this->getDigit($intComponent)) { // digit?
                    $arrComponentWords[$strComponent] = $this->getDigit($intComponent);
                } else if (10 < $intComponent && 100 > $intComponent) { // 11-99
                    $arrComponentWords[$strComponent] = ($this->getPrefix($strComponent[0]) ? $this->getPrefix($strComponent[0]) : $this->getDigit($strComponent[0])) . 'ty';
                } else { // else unsure
                    $arrComponentWords[$strComponent] = false;
                }
            }

            if ('ten' == $arrComponentWords[$arrComponents[0]]) {
                return $arrComponentWords[$arrComponents[1]] . 'teen';
            } else if (2 === sizeof($arrComponents)) {
                if (0 == $arrComponents[1]) {
                    return $arrComponentWords[$arrComponents[0]];
                } else {
                    return $arrComponentWords[$arrComponents[0]] . '-' . $arrComponentWords[$arrComponents[1]];
                }
            } else {
                return implode($arrComponentWords, ' ');
            }
        }

        return $strWordNumber;
    }

    private function splitToComponents($intNumber)
    {
        $strNumber = strval($intNumber);
        $arrNumber = str_split($strNumber);
        $arrComponents = [];

        foreach(array_reverse($arrNumber) as $k => $strDigit) {
            $arrComponents[] = $strDigit . str_repeat('0', $k);
        }

        return array_reverse($arrComponents);
    }

    private function getDigit($intDigit)
    {
        return isset(self::digits[$intDigit]) ? self::digits[$intDigit] : false;
    }

    private function getPrefix($intNumber)
    {
        return isset(self::prefixes[$intNumber]) ? self::prefixes[$intNumber] : false;
    }

    private function getIllogical($intNumber)
    {
        return isset(self::illogicals[$intNumber]) ? self::illogicals[$intNumber] : false;
    }
}
