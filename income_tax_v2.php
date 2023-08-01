<?php

define(
  'TAX_RATES',
  array(
    'Single' => array(
      'Rates' => array(10, 12, 22, 24, 32, 35, 37),
      'Ranges' => array(0, 9700, 39475, 84200, 160725, 204100, 510300),
      'MinTax' => array(0, 970, 4543, 14382, 32748, 46628, 153798)
    ),
    'Married_Jointly' => array(
      'Rates' => array(10, 12, 22, 24, 32, 35, 37),
      'Ranges' => array(0, 19400, 78950, 168400, 321450, 408200, 612350),
      'MinTax' => array(0, 1940, 9086, 28765, 65497, 93257, 164709)
    ),
    'Married_Separately' => array(
      'Rates' => array(10, 12, 22, 24, 32, 35, 37),
      'Ranges' => array(0, 9700, 39475, 84200, 160725, 204100, 306175),
      'MinTax' => array(0, 970, 4543, 14382.50, 32748.50, 46628.50, 82354.75)
    ),
    'Head_Household' => array(
      'Rates' => array(10, 12, 22, 24, 32, 35, 37),
      'Ranges' => array(0, 13850, 52850, 84200, 160700, 204100, 510300),
      'MinTax' => array(0, 1385, 6065, 12962, 31322, 45210, 152380)
    )
  )
);

// Fill in the code for the following function

// Function to calculate income tax based on taxable income and status
function incomeTax($taxableIncome, $status)
{
  $taxRates = TAX_RATES[$status];  // Get the tax rates for the given status
  // Iterate over the tax rate ranges in reverse order
  for ($i = count($taxRates['Ranges']) - 1; $i >= 0; $i--) {
    // If the taxable income is greater than the current range's lower limit
    if ($taxableIncome > $taxRates['Ranges'][$i]) {
      // Return the minimum tax for this range plus the tax on the income above the range
      return $taxRates['MinTax'][$i] + $taxRates['Rates'][$i] / 100 * ($taxableIncome - $taxRates['Ranges'][$i]);
    }
  }
  return 0; // If the income is too low to be taxed, return zero

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>HW4 Part2 - LastName</title>

  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>

<body>

  <div class="container">

    <h3>Income Tax Calculator</h3>

    <form class="form-horizontal" method="post">

      <div class="form-group">
        <label class="control-label col-sm-2">Enter Net Income:</label>
        <div class="col-sm-10">
          <input type="number" step="any" name="netIncome" placeholder="Taxable  Income" required autofocus>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>

    </form>

    <?php

    // Fill in the rest of the PHP code for form submission results

    if (isset($_POST['netIncome'])) {
      $netIncome = $_POST['netIncome'];
      echo "With a net taxable income of: $" . number_format($netIncome, 2) . "<br/>";
      echo "<table class='table table-striped table-bordered table-hover'>"; 
      echo "<thead><tr><th>Status</th><th>Tax</th></tr></thead>";
      echo "<tbody>";
      foreach (TAX_RATES as $status => $values) {
        $tax = incomeTax($netIncome, $status);
        echo "<tr>";
        echo "<td>" . $status . "</td>";
        echo "<td>$" . number_format($tax, 2) . "</td>";
        echo "</tr>";
      }
      echo "</tbody>";
      echo "</table>";
    }

    ?>

    <h3>2019 Tax Tables</h3>

    <?php
    // Loop through each status and their corresponding tax rates
    foreach (TAX_RATES as $status => $values) {
      echo "<h4>" . $status . "</h4>";
      echo "<table class='table table-striped table-bordered table-hover'>"; 
      echo "<thead><tr><th>Range</th><th>Rate</th><th>Min Tax</th></tr></thead>";
      echo "<tbody>";
      // Loop through each tax rate for the current status
      for ($i = 0; $i < count($values['Rates']); $i++) {
        echo "<tr>";
        // Display the income range for this tax rate
        echo "<td>$" . number_format($values['Ranges'][$i] + 1) . " - $" . ($i < count($values['Rates']) - 1 ? number_format($values['Ranges'][$i + 1]) : "or more") . "</td>";
        // Display the tax rate for this range
        echo "<td>" . $values['Rates'][$i] . "%</td>";
        // Display the minimum tax for this range
        echo "<td>$" . number_format($values['MinTax'][$i], 2) . "</td>";
        echo "</tr>";
      }
      echo "</tbody>";
      echo "</table>";
    }

    ?>

  </div>

</body>

</html>