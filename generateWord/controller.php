<?php
$value = $_POST['value'];
print "Value: $value";
print "<br>";

class myClass
{
    private $num;
    function __construct($num)
    {
        $this->num = $num;
    }

    public function generateWord()
    {
        $count_multiple_word = 0;


        for ($i = 1; $i <= $this->num; $i++) {
            if ($i % 3 == 0 && $i % 5 == 0) {
               print "Pasar 20 Belanja pangan" . "<br>";
                $count_multiple_word += 1;
            } elseif ($i % 3 === 0) {
               print $count_multiple_word == 2 ? "Belanja Pangan". "<br>" : "Pasar 20" . "<br>";
            } elseif ($i % 5 === 0) {
               print $count_multiple_word == 2 ? "Pasar 20". "<br>" : "Belanja pangan" . "<br>";
            } else if ($count_multiple_word == 5) {
                break;
            }
        }
    }
}
$myObject = new myClass($value);
$myObject->generateWord();
