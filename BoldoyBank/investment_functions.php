<?php
// Функция для расчета процентов по вкладу
function calculateInterest($principal, $duration, $interestRate) {
  $interest = $principal * $interestRate * $duration;
  return $interest;
}

