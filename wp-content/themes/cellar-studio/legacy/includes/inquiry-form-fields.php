<?php
$prefix = isset($inquiryFieldPrefix) ? preg_replace('/[^a-z0-9-]/i', '', (string) $inquiryFieldPrefix) : 'inquiry';
if ($prefix === '') {
	$prefix = 'inquiry';
}

$propertyOptions = [
	'Private Villa' => 'Private Villa',
	'Apartment / Penthouse' => 'Apartment / Penthouse',
	'Hospitality / Restaurant' => 'Hospitality / Restaurant',
	'Commercial' => 'Commercial',
	'Other' => 'Other',
];
?>
<div>
	<label for="<?php echo htmlspecialchars($prefix, ENT_QUOTES, 'UTF-8'); ?>-name" class="form-label contact-form-label">Full Name <span class="contact-required" aria-hidden="true">*</span></label>
	<div class="contact-field">
		<span class="contact-field-icon" aria-hidden="true">
			<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2M12 11a4 4 0 100-8 4 4 0 000 8z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
			</svg>
		</span>
		<input type="text" class="form-control contact-field-input" id="<?php echo htmlspecialchars($prefix, ENT_QUOTES, 'UTF-8'); ?>-name" name="name" autocomplete="name" placeholder="Your full name" required>
	</div>
</div>

<div>
	<label for="<?php echo htmlspecialchars($prefix, ENT_QUOTES, 'UTF-8'); ?>-phone" class="form-label contact-form-label">Phone / WhatsApp <span class="contact-required" aria-hidden="true">*</span></label>
	<div class="contact-field contact-field--phone">
		<label class="visually-hidden" for="<?php echo htmlspecialchars($prefix, ENT_QUOTES, 'UTF-8'); ?>-phone-prefix">Country code</label>
		<select class="form-select contact-phone-prefix" id="<?php echo htmlspecialchars($prefix, ENT_QUOTES, 'UTF-8'); ?>-phone-prefix" name="phone_prefix" aria-label="Country calling code">
			<option value="+33">FR +33</option>
			<option value="+971" selected>AE +971</option>
			<option value="+41">CH +41</option>
			<option value="+44">UK +44</option>
		</select>
		<input type="tel" class="form-control contact-field-input" id="<?php echo htmlspecialchars($prefix, ENT_QUOTES, 'UTF-8'); ?>-phone" name="phone" autocomplete="tel" placeholder="50 123 4567" required>
	</div>
</div>

<div>
	<label for="<?php echo htmlspecialchars($prefix, ENT_QUOTES, 'UTF-8'); ?>-email" class="form-label contact-form-label">Email Address <span class="contact-required" aria-hidden="true">*</span></label>
	<div class="contact-field">
		<span class="contact-field-icon" aria-hidden="true">
			<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M4 6h16v12H4V6zm0 0l8 6 8-6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</span>
		<input type="email" class="form-control contact-field-input" id="<?php echo htmlspecialchars($prefix, ENT_QUOTES, 'UTF-8'); ?>-email" name="email" autocomplete="email" placeholder="you@email.com" required>
	</div>
</div>

<fieldset class="inquiry-property">
	<legend class="form-label contact-form-label">What type of property is this? <span class="contact-required" aria-hidden="true">*</span></legend>
	<div class="inquiry-property-list" role="radiogroup" aria-required="true">
		<?php foreach ($propertyOptions as $value => $label) :
			$id = $prefix . '-property-' . preg_replace('/[^a-z0-9]+/i', '-', strtolower($value));
			?>
			<label class="inquiry-property-option" for="<?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>">
				<input type="radio" id="<?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>" name="property_type" value="<?php echo htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); ?>" required>
				<span><?php echo htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?></span>
			</label>
		<?php endforeach; ?>
	</div>
</fieldset>

<div>
	<label for="<?php echo htmlspecialchars($prefix, ENT_QUOTES, 'UTF-8'); ?>-location" class="form-label contact-form-label">Where is your project located?</label>
	<div class="contact-field">
		<span class="contact-field-icon" aria-hidden="true">
			<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M12 21s7-4.35 7-10a7 7 0 10-14 0c0 5.65 7 10 7 10z" stroke="currentColor" stroke-width="1.5"/>
				<circle cx="12" cy="11" r="2.5" stroke="currentColor" stroke-width="1.5"/>
			</svg>
		</span>
		<input type="text" class="form-control contact-field-input" id="<?php echo htmlspecialchars($prefix, ENT_QUOTES, 'UTF-8'); ?>-location" name="location" autocomplete="address-level2" placeholder="City / Area (e.g. Palm Jumeirah, Emirates Hills...)">
	</div>
</div>

<div>
	<label for="<?php echo htmlspecialchars($prefix, ENT_QUOTES, 'UTF-8'); ?>-message" class="form-label contact-form-label">Tell us about your project</label>
	<div class="contact-field contact-field--textarea">
		<span class="contact-field-icon" aria-hidden="true">
			<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M12 20h9M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1 1-4L16.5 3.5z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</span>
		<textarea class="form-control contact-field-input contact-field-textarea" id="<?php echo htmlspecialchars($prefix, ENT_QUOTES, 'UTF-8'); ?>-message" name="message" rows="4" placeholder="What would you like to create? Any details about the space, collection, or requirements..."></textarea>
	</div>
</div>
