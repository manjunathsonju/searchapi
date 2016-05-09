<div id="floating-panel">
      <?php echo form_open('welcome/gecodetweets');
      echo form_input('address');
      // <input id="address" type="textbox" value="Sydney, NSW">
      // <input id="submit" type="button" value="Geocode">
      echo form_submit('submit', 'Submit Address');
      echo form_close();
      ?>
 </div>