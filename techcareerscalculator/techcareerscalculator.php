<?php
/*
Plugin Name: Tech Careers Calculator
Plugin URI: http://techcareers.ca/
Description: An example plugin for techcareers class. It provides an example of a wordpress shortcode. Type [techcareerscalculator] into a page ot post to output our calculator.
Author: Shailza Sharma
Version: 1.7.2
Author URI: http://techcareers.ca/
*/
/**
 * Original source code:
 * @link https://github.com/TECHCareers-by-Manpower/4.1-php-advanced

 */

// In PHP, when we want to make a constant, we use the "define()" function.
// The first argument is the constant name, the second is its value.
// We can call upon constants directly by their name (without quotes) to access their value.
// It is convention for constants to be in all caps.
define( 'TECHCAREERS_CALC_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
include_once plugin_dir_path( __FILE__ ).'/includes/enqueue.php';

// Link the "shortcode" name to our function name.
add_shortcode(
  'techcareerscalculator', // The name between square brackets that our client can type into a post / page.
  'outputTechCareersCalculator' // The actual name of our function.
);
function outputTechCareersCalculator () {
  // Prepare to store some warnings for the user...
  $warnings = array();

  // Check if the form fields are all submitted...
  /**
   * isset() Checks to see if a value is declared / defined at all.
   * empty() Checks to see if a value is an empty string, zero, or the array has no elements.
   */
  if ( isset( $_GET['num1'] ) && !empty( $_GET['num1'] ) ) {
    $num1 = (integer) $_GET['num1']; // We can type-cast this to a number using (integer) before the value. It does its best to convert to integer in this case.
  } else {
    $warnings[] = 'First operand is missing.'; // array_push( $warnings, 'New warning.' )
  }
  if ( isset( $_GET['operator'] ) ) {
    $operator = (string) $_GET['operator'];
  } else {
    $warnings[] = 'Operator is missing.';
  }
  if ( isset( $_GET['num2'] ) && !empty( $_GET['num2'] ) ) {
    $num2 = (integer) $_GET['num2'];
  } else {
    $warnings[] = 'Second operand is missing.';
  }

  // Make sure we have values we can use.
  if ( isset( $num1 ) && isset( $operator ) && isset( $num2 ) ) {
    switch ( $operator ) {
      case 'add':
        $result = $num1 + $num2;
        break;
      case 'subtract':
        $result = $num1 - $num2;
        break;
      case 'multiply':
        $result = $num1 * $num2;
        break;
      case 'divide':
        $result = $num1 / $num2;
        break;
    }
  }
  // Start an output buffer (echos after this point are NOT sent to the browser, until we clear the buffer.)
  ob_start();
  ?>
    <h2>PHP Calculator Form</h2>
    <form action="#" method="GET" id="techcareers-calculator-wp-plugin">
      <?php if ( !empty( $warnings ) ) : ?>
        <ul>
          <?php foreach ( $warnings as $warning ) : ?>
            <li>
              <?php echo $warning; ?>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
      <label for="num1">
        First Operand:
        <input type="number" name="num1" id="num1">
      </label>
      <label for="operator">
        Operator:
        <select name="operator" id="operator">
          <option value="add">+</option>
          <option value="subtract">-</option>
          <option value="multiply">&times;</option>
          <option value="divide">&divide;</option>
        </select>
      </label>
      <label for="num2">
        Second Operand:
        <input type="number" name="num2" id="num2">
      </label>
      <input type="submit" value="Get Result">
      <?php if ( isset( $result ) ) : ?>
        <label for="result">
          Result:
          <input type="number" value="<?php echo $result; ?>" disabled>
        </label>
      <?php endif; ?>
    </form>
  <?php
  // ob_get_clean retrieves the buffer as a string, and cleans (ends and deletes the above buffer from RAM.)
  return ob_get_clean(); // The HTML we made is returned.
}