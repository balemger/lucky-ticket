<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * TicketForm is the model behind the ticket form.
 */
class TicketForm extends Model
{
    public $nFrom;
    public $nTo;
    protected $digits = 3;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // nFrom and nTo are required
            [['nFrom', 'nTo'], 'required'],
            // trims the white spaces surrounding "nFrom" and "nTo"
            [['nFrom', 'nTo'], 'trim'],
            // nFrom and nTo are integer between 1 and 999999
            [['nFrom', 'nTo'], 'integer', 'min' => 1, 'max' => 999999],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'nFrom' => 'N - from',
            'nTo' => 'N - to',
        ];
    }

    /**
     * Calculates the number of lucky tickets in the given range using the information collected by this model.
     * @return int returns the number of lucky tickets.
     */
    public function getLuckyTicketCount()
    {
        $ticketsCount = 0;
        if ($this->validate()) {
            $nFrom = (int) $this->nFrom;
            $nTo = (int) $this->nTo;
            $minPossibleStart = pow(10, $this->digits);
            $from = max($nFrom, $minPossibleStart);
            if ($nFrom <= $nTo) {
                for ($i = $from; $i <= $nTo; $i++) {
                    if ($this->isLuckyTicket($i)) {
                        $ticketsCount++;
                    }
                }
            }
        }
        return $ticketsCount++;
    }

    /**
     * Determines if the ticket is lucky
     * @return bool return true if the ticket is lucky.
     */
    public function isLuckyTicket($number)
    {
        $delimiter = pow(10, $this->digits);
        $first = (int) ($number / $delimiter);
        $second = $number - ($first * $delimiter);
        return $this->getDigits($first) === $this->getDigits($second);
    }

    /**
     * Get the sum of numbers
     * @return integer return the sum of numbers.
     */
    public function getDigits($num)
    {
        while ($num >= 10) {
            $num = ((int) ($num / 10)) + ($num % 10);
        }
        return $num;
    }

    /**
     * Calculates the number of lucky tickets without cycle using mathematical regularity
     * @return int returns the number of lucky tickets.
     */
    public function getMathLuckyTicketCount()
    {
        $nFrom = (int) $this->nFrom;
        $minPossibleStart = pow(10, $this->digits);
        $nFrom = max($nFrom, $minPossibleStart);
        $nTo = (int) $this->nTo;
        $delimiter = pow(10, $this->digits);

        $nFromPart2PlusVariants = $this->getPlusVars($nFrom, $delimiter);
        $nToPart2PlusVariants = $this->getPlusVars($nTo, $delimiter);

        $result =  111 * ((int) ($nTo / $delimiter) - $nFrom % $delimiter) + $nToPart2PlusVariants - $nFromPart2PlusVariants;
        if ($this->isLuckyTicket($nFrom)) {
            $result++;
        }
        return $result;
    }

    /**
     * Calculates the number of lucky possible lucky ticket variants
     * @return int returns the number of lucky tickets.
     */
    public function getPlusVars($number, $delimiter)
    {
        $nPart1 = (int) ($number / $delimiter);
        $nPart2 = $number % $delimiter;
        $nPart1Digits = $this->getDigits($nPart1);
        $nPart2Nines = (int) ($nPart2 / 9);
        return $nPart2 - $nPart2Nines * 9 >= $nPart1Digits ? $nPart2Nines + 1 : $nPart2Nines;
    }


}
