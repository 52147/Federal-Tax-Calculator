<?php

// Fill in the code for the following four functions

// Function to calculate income tax for a single individual
function incomeTaxSingle($income)
{
    $tax = 0.0;
    if ($income <= 9700) {
        $tax = $income * 0.10;
    } else if ($income <= 39475) {
        $tax = 970 + (($income - 9700) * 0.12);
    } else if ($income <= 84200) {
        $tax = 4543 + (($income - 39475) * 0.22);
    } else if ($income <= 160725) {
        $tax = 14382 + (($income - 84200) * 0.24);
    } else if ($income <= 204100) {
        $tax = 32748 + (($income - 160725) * 0.32);
    } else if ($income <= 510300) {
        $tax = 46628 + (($income - 204100) * 0.35);
    } else {
        $tax = 153798 + (($income - 510300) * 0.37);
    }
    return $tax;
}

// Function to calculate income tax for a married couple filing jointly
function incomeTaxMarriedJointly($income)
{
    $tax = 0.0;
    if ($income <= 19400) {
        $tax = $income * 0.10;
    } else if ($income <= 78950) {
        $tax = 1940 + (($income - 19400) * 0.12);
    } else if ($income <= 168400) {
        $tax = 9086 + (($income - 78950) * 0.22);
    } else if ($income <= 321450) {
        $tax = 28765 + (($income - 168400) * 0.24);
    } else if ($income <= 408200) {
        $tax = 65497 + (($income - 321450) * 0.32);
    } else if ($income <= 612350) {
        $tax = 93257 + (($income - 408200) * 0.35);
    } else {
        $tax = 164709 + (($income - 612350) * 0.37);
    }
    return $tax;
}

// Function to calculate income tax for a married individual filing separately
function incomeTaxMarriedSeparately($income)
{
    $tax = 0.0;
    if ($income <= 9700) {
        $tax = $income * 0.10;
    } else if ($income <= 39475) {
        $tax = 970 + (($income - 9700) * 0.12);
    } else if ($income <= 84200) {
        $tax = 4543 + (($income - 39475) * 0.22);
    } else if ($income <= 160725) {
        $tax = 14382.50 + (($income - 84200) * 0.24);
    } else if ($income <= 204100) {
        $tax = 32748.50 + (($income - 160725) * 0.32);
    } else if ($income <= 306175) {
        $tax = 46628.50 + (($income - 204100) * 0.35);
    } else {
        $tax = 82354.75 + (($income - 306175) * 0.37);
    }
    return $tax;
}

// Function to calculate income tax for a head of household
function incomeTaxHeadOfHousehold($income)
{
    $tax = 0.0;
    if ($income <= 13850) {
        $tax = $income * 0.10;
    } else if ($income <= 52850) {
        $tax = 1385 + (($income - 13850) * 0.12);
    } else if ($income <= 84200) {
        $tax = 6065 + (($income - 52850) * 0.22);
    } else if ($income <= 160700) {
        $tax = 12962 + (($income - 84200) * 0.24);
    } else if ($income <= 204100) {
        $tax = 31322 + (($income - 160700) * 0.32);
    } else if ($income <= 510300) {
        $tax = 45210 + (($income - 204100) * 0.35);
    } else {
        $tax = 152380 + (($income - 510300) * 0.37);
    }
    return $tax;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>HW4 Part1 - LastName</title>

    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">

        <h3>Income Tax Calculator</h3>

        <form class="form-horizontal" method="post">


            <div class="form-group">
                <label class="control-label col-sm-2" for="netIncome">Your Net Income:</label>
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

        // Check if the net income value has been submitted
        if (isset($_POST['netIncome'])) {
            // Save the submitted net income value
            $netIncome = $_POST['netIncome'];
            // Output the net taxable income with formatting
            echo "With a net taxable income of: $" . number_format($netIncome, 2) . "<br/>";
            // Start creating a bootstrap styled table
            echo "<table class='table table-striped table-bordered table-hover'>";
            echo "<thead><tr><th>Status</th><th>Tax</th></tr></thead>";
            echo "<tbody>";
            // Calculate and output the income tax for different individual
            echo "<tr><td>Single</td><td>$" . number_format(incomeTaxSingle($netIncome), 2) . "</td></tr>";
            echo "<tr><td>Married Filling Jointly</td><td>$" . number_format(incomeTaxMarriedJointly($netIncome), 2) . "</td></tr>";
            echo "<tr><td>Married Filling Separately</td><td>$" . number_format(incomeTaxMarriedSeparately($netIncome), 2) . "</td></tr>";
            echo "<tr><td>Head of Household</td><td>$" . number_format(incomeTaxHeadOfHousehold($netIncome), 2) . "</td></tr>";
            echo "</tbody>";
            echo "</table>";
        }

        ?>

    </div>

</body>

</html>