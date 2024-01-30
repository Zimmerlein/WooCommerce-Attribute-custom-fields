<?php
// Add fields to the add and edit attribute forms
add_action('woocommerce_after_add_attribute_fields', 'add_custom_attribute_fields');
add_action('woocommerce_after_edit_attribute_fields', 'edit_custom_attribute_fields');

// Save the custom meta when attribute is created or updated
add_action('woocommerce_attribute_added', 'save_custom_attribute_meta', 10, 2);
add_action('woocommerce_attribute_updated', 'save_custom_attribute_meta', 10, 2);

// Function to display custom field in add attribute form
function add_custom_attribute_fields() {
    ?>
    <div class="form-field">
        <label for="attribute_description"><?php _e('Beskrivelse', 'woocommerce'); ?></label>
		<textarea name="attribute_description" id="attribute_description" rows="5" cols="50"></textarea>
		<p class="description"><?php _e('Beskrivelsen vises i ikonet ud for egenskaben på produktsiden.', 'woocommerce'); ?></p>
    </div>
    <?php
}

// Function to display custom field in edit attribute form
function edit_custom_attribute_fields($attribute) {
	$attribute_id = $_GET['edit'];
	if(is_numeric($attribute_id)){
    	$meta_value = get_term_meta($attribute_id, 'attribute_description', true);
	}
    ?>
    <tr class="form-field">
        <th scope="row">
            <label for="attribute_description"><?php _e('Beskrivelse', 'woocommerce'); ?></label>
        </th>
        <td>
            <textarea name="attribute_description" id="attribute_description" rows="5" cols="50"><?php echo esc_attr($meta_value); ?></textarea>
			<p class="description"><?php _e('Beskrivelsen vises i ikonet ud for egenskaben på produktsiden.', 'woocommerce'); ?></p>
        </td>
    </tr>
    <?php
}

// Function to save custom field data
function save_custom_attribute_meta($attribute_id, $data) {
    if (isset($_POST['attribute_description'])) {
        update_term_meta($attribute_id, 'attribute_description', sanitize_text_field($_POST['attribute_description']));
    }
}
