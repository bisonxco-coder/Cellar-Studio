<?php
if (!defined('ABSPATH')) {
	exit;
}

/**
 * One prepared article every two days.
 * The queue does not invent a new topic when it runs out.
 * Each item uses facts already stated on the website.
 */
function cellar_studio_blog_queue(): array {
	$bespoke = home_url('/bespoke/');
	$fridge = home_url('/wine-fridge/');
	$cigar = home_url('/cigar-humidors/');
	$racking = home_url('/wine-racking-solutions/');
	$contact = home_url('/contact/');
	$about = home_url('/about/');

	return [
		[
			'slug' => 'how-a-cellar-studio-project-starts-in-dubai',
			'title' => 'How a Cellar Studio Project Starts in Dubai',
			'excerpt' => 'A Cellar Studio project in Dubai starts with a consultation about the space, the collection, and the timeline, then moves through design and installation.',
			'faqs' => [
				[
					'q' => 'How do I begin a project with Cellar Studio?',
					'a' => 'Start with a consultation. Share the space, the timeline, and what you want to store or display. Cellar Studio then outlines measurements, concepts, and the next proposal.',
				],
				[
					'q' => 'Where is Cellar Studio based?',
					'a' => 'Cellar Studio is at Swiss Tower, Cluster Y, Jumeirah Lakes Towers, Dubai. The studio can be reached at +971 50 912 4567 or sacha@cellar-studio.com, Monday to Saturday, 08:00 to 21:00.',
				],
			],
			'body' => <<<HTML
<p>A Cellar Studio project in Dubai starts with a consultation, not with a finished drawing. The studio designs and installs bespoke wine cellars, wine walls, and cigar rooms, and the first conversation is about the room you already have, the collection you want to keep, and the date you need the space ready.</p>
<p>Cellar Studio is a Swiss–French team working in Dubai, the UAE, and Switzerland. Sacha Christe and Florian Grolleau lead the studio. The showroom address is Swiss Tower, Cluster Y, Jumeirah Lakes Towers. You can call +971 50 912 4567 or email sacha@cellar-studio.com. Support hours are Monday to Saturday, 08:00 to 21:00.</p>
<h2>What to share in the first conversation</h2>
<p>Bring the floor plan if you have one, a few photographs of the room, and a plain description of the collection. A private villa, an apartment, and a hospitality space do not need the same layout. Say whether you want a full <a href="{$bespoke}">bespoke cellar</a>, a <a href="{$fridge}">wine fridge</a> integrated into joinery, a <a href="{$cigar}">cigar room</a>, or <a href="{$racking}">wine racking</a> inside an existing room.</p>
<p>The studio then sets the next steps: measurements, a concept, and a proposal. Installation is part of the same project. Cellar Studio manages the on-site fit, coordination, and a check that the finished space matches the approved design.</p>
<h2>What the studio specifies</h2>
<p>Materials named on the website include solid hardwood, architectural glass, powder-coated metal, natural stone, and climate-resistant finishes. Wine refrigeration is specified with Swisscave. Cigar storage is specified with Raching. Climate equipment is coordinated so the storage conditions stay stable. The exact system depends on the room, so it is confirmed in the proposal rather than guessed from a photograph.</p>
<p>If the project is outside the UAE, Cellar Studio can discuss international delivery where the product type and local rules allow it. That scope is confirmed per project. To start, use the <a href="{$contact}">contact form</a> or the details on the <a href="{$about}">about page</a>.</p>
HTML,
		],
		[
			'slug' => 'wine-wall-or-dedicated-cellar-room',
			'title' => 'Wine Wall or a Dedicated Cellar Room',
			'excerpt' => 'A wine wall suits a living space that should show the collection. A dedicated cellar suits larger storage and a separate climate zone. Cellar Studio designs both in Dubai.',
			'faqs' => [
				[
					'q' => 'When is a wine wall enough?',
					'a' => 'A wine wall is enough when the collection should stay in a living, dining, or reception room and the priority is display as well as storage. Cellar Studio designs wine walls as part of a bespoke interior.',
				],
				[
					'q' => 'When does a home need a separate cellar room?',
					'a' => 'A separate cellar room suits a larger collection, a tasting space, or a room that can hold its own climate system. The choice is made after the space and the collection are reviewed.',
				],
			],
			'body' => <<<HTML
<p>Choose a wine wall when the bottles should live in a room you already use. Choose a dedicated cellar when the collection needs its own room and its own climate zone. Cellar Studio designs both for homes and hospitality in Dubai and the UAE.</p>
<p>A wine wall is a display and storage element inside a living room, dining room, or reception. It can combine <a href="{$racking}">racking</a>, glass, lighting, and sometimes a <a href="{$fridge}">wine fridge</a>. The point is that the collection stays visible and the room still works as a social space.</p>
<h2>When a separate room is the better fit</h2>
<p>A dedicated cellar is the better fit when the collection is large, when guests should taste wine away from the main rooms, or when the cooling equipment needs a room of its own. <a href="{$bespoke}">Bespoke cellar</a> work covers the layout, the joinery, and the climate coordination from concept to installation.</p>
<p>Neither choice is automatic. Cellar Studio asks for the architecture, the size of the collection, and how you use the room. A villa in Dubai and a city apartment can both take a wine wall. A separate cellar needs a room that can be enclosed and serviced.</p>
<h2>What stays the same in both options</h2>
<p>Both options are built to work with professional climate control. The studio coordinates the engineering so storage conditions stay stable. Finishes can include hardwood, glass, metal, and stone. Swisscave units are the wine-fridge range named on the site. If you are deciding between the two, send the room photographs through the <a href="{$contact}">project enquiry</a> and say which rooms you are willing to use.</p>
HTML,
		],
		[
			'slug' => 'what-to-prepare-before-a-cellar-consultation',
			'title' => 'What to Prepare Before a Cellar Consultation',
			'excerpt' => 'Before a Cellar Studio consultation, gather the room size, a few photographs, the collection size, and the date you want the space finished.',
			'faqs' => [
				[
					'q' => 'Do I need a finished design before I contact Cellar Studio?',
					'a' => 'No. The consultation is the start. Share the space, the timeline, and the goal. Cellar Studio uses that to plan measurements and the concept.',
				],
				[
					'q' => 'Can an existing product be changed to fit the room?',
					'a' => 'Many products can change in finish, size, or configuration. Cellar Studio confirms what can be adapted, and the lead time, after the requirements are known.',
				],
			],
			'body' => <<<HTML
<p>You do not need a finished design before you speak to Cellar Studio. You do need a clear picture of the room, the collection, and the date. That is enough to start a consultation for a wine cellar, a wine wall, or a cigar room in Dubai.</p>
<h2>Bring these four things</h2>
<p>First, the rough size of the room or the niche, even if it is only a width and a height from a tape measure. Second, photographs in daylight, including the ceiling, the floor, and anything that cannot move, such as a column or a door. Third, an idea of how many bottles or cigars you want to store, or a description of the collection if you do not have a count. Fourth, the timeline, including whether the home is still under construction.</p>
<p>If an architect or interior designer is already on the project, include them in the conversation. Cellar Studio works from concept through installation, and early coordination avoids a cellar that does not fit the joinery.</p>
<h2>What happens after you send the enquiry</h2>
<p>The studio reviews the space and says which direction fits: a <a href="{$bespoke}">bespoke room</a>, <a href="{$racking}">racking</a> in an existing interior, a <a href="{$fridge}">wine fridge</a>, or a <a href="{$cigar}">cigar humidor or cigar room</a>. Products in the collection can often change in finish, size, or configuration. The studio confirms what is possible, and the lead time, before anything is ordered.</p>
<p>Send the material through the <a href="{$contact}">contact page</a>. The phone number is +971 50 912 4567 and the email is sacha@cellar-studio.com.</p>
HTML,
		],
		[
			'slug' => 'planning-a-private-cigar-room-in-dubai',
			'title' => 'Planning a Private Cigar Room in Dubai',
			'excerpt' => 'A private cigar room in Dubai needs a dedicated space, controlled humidity, and a layout for storage and seating. Cellar Studio designs and installs cigar rooms and humidors.',
			'faqs' => [
				[
					'q' => 'Does Cellar Studio build cigar rooms as well as humidors?',
					'a' => 'Yes. Cellar Studio designs custom cigar humidors and cigar rooms, and installs them. Raching is the cigar partner named on the website.',
				],
				[
					'q' => 'Can a cigar room sit next to a wine cellar?',
					'a' => 'Yes, when the architecture allows two zones. Wine and cigars need different conditions, so the layout and the climate equipment are planned as separate systems inside one project.',
				],
			],
			'body' => <<<HTML
<p>A private cigar room in Dubai needs its own zone. Cigars need stable humidity, and that zone should not be left to the same conditions as a wine cellar. Cellar Studio designs custom cigar humidors and cigar rooms, then installs them.</p>
<p>The <a href="{$cigar}">cigar humidors</a> page is the place to start if the collection is the main brief. A humidor can sit inside a study or a dressing room. A cigar room is the larger version: storage, a place to sit, and ventilation planned with the interior. Raching is the partner named for this range.</p>
<h2>Plan the room before the furniture</h2>
<p>Decide who uses the room and whether it is private or for guests. A room that opens directly onto a living space needs a door and a seal that the design can work with. Tell Cellar Studio about air conditioning that is already in the ceiling, because the cigar zone has to live with the rest of the house system.</p>
<p>The studio does not publish one humidity figure for every room. The condition is specified for the collection and the site, then engineered so it stays stable. That is the same approach used for wine: the equipment is coordinated, not added as an afterthought.</p>
<h2>Keeping wine and cigars in one home</h2>
<p>Many Dubai homes want both. A <a href="{$bespoke}">bespoke project</a> can place a wine cellar or <a href="{$fridge}">wine fridge</a> and a cigar room in the same residence, as long as each zone has its own brief. Share both goals in the <a href="{$contact}">first enquiry</a> so the layout is drawn once.</p>
HTML,
		],
		[
			'slug' => 'how-to-choose-wine-racking-for-a-villa',
			'title' => 'How to Choose Wine Racking for a Villa',
			'excerpt' => 'Villa wine racking should match the bottle count, the way you display the collection, and the climate system. Cellar Studio designs bespoke and ready-made racking.',
			'faqs' => [
				[
					'q' => 'Does Cellar Studio only build fully custom racking?',
					'a' => 'No. Cellar Studio offers bespoke racking and ready-made racking, in a range of materials, finishes, and presentation styles.',
				],
				[
					'q' => 'Will the racking work with a cooling system?',
					'a' => 'Yes. The racking is specified to work with professional climate and humidity control, and Cellar Studio coordinates that engineering.',
				],
			],
			'body' => <<<HTML
<p>Choose villa wine racking from the number of bottles, the way you want to see them, and the climate system in the room. Cellar Studio designs both fully bespoke racking and ready-made systems for residential and commercial cellars.</p>
<p>The <a href="{$racking}">wine racking</a> range covers materials and finishes that change the look of the room: wood, metal, and presentation styles that show labels or keep the bottles in a denser grid. Capacity and display are decided together. A dense grid stores more. An open display uses more wall for the same number of bottles.</p>
<h2>Match the racking to the room</h2>
<p>In a villa, racking often shares a wall with joinery, a staircase, or a tasting table. Measure the openings before you choose a module. A ready-made system is the right fit when the wall is regular and the finish you want is already in the collection. A bespoke system is the right fit when the wall is angled, interrupted, or part of a larger <a href="{$bespoke}">cellar interior</a>.</p>
<p>Racking is specified to work with professional cooling. If the room will also have a <a href="{$fridge}">wine fridge</a>, say so at the start so the fridge opening and the racking modules do not compete for the same space.</p>
<h2>Installation</h2>
<p>Cellar Studio installs the system and checks it against the approved design. If you are comparing two layouts, send both ideas, or the architect’s drawing, through the <a href="{$contact}">enquiry form</a>. The studio will say which layout fits the collection and the lead time.</p>
HTML,
		],
		[
			'slug' => 'when-a-wine-fridge-is-the-right-choice',
			'title' => 'When a Wine Fridge Is the Right Choice',
			'excerpt' => 'A wine fridge is the right choice when you need a controlled cabinet inside a kitchen, living room, or hospitality space. Cellar Studio specifies Swisscave units in the UAE.',
			'faqs' => [
				[
					'q' => 'Who supplies the wine fridges Cellar Studio installs?',
					'a' => 'Cellar Studio specifies Swisscave wine fridges for homes and hospitality in the UAE, including freestanding and integrated units.',
				],
				[
					'q' => 'Can a wine fridge be built into joinery?',
					'a' => 'Yes. Integrated wine fridges are part of the range. The cabinet size and ventilation have to be confirmed before the joinery is built.',
				],
			],
			'body' => <<<HTML
<p>A wine fridge is the right choice when the collection fits in a controlled cabinet and the room does not need a full cellar. Cellar Studio specifies Swisscave wine fridges for homes and hospitality in the UAE, both freestanding and integrated.</p>
<p>Use a fridge when the bottles live in a kitchen, a living room, or a restaurant service area, and when you want temperature control without building a separate room. Use a <a href="{$bespoke}">cellar or wine wall</a> when the collection is larger than a cabinet or when the bottles are part of the architecture. The comparison is also covered in the studio’s guide to cellars and fridges.</p>
<h2>Integrated or freestanding</h2>
<p>A freestanding unit can stand in an existing niche if the ventilation the manufacturer requires is available. An integrated unit is built into joinery. That joinery has to be drawn around the real cabinet size, not around a guess. Cellar Studio confirms the model on the <a href="{$fridge}">wine fridge</a> page and during the consultation, before the cabinetmaker closes the opening.</p>
<p>Many units can change in finish or configuration. Ask what can be adapted. The answer depends on the model and the lead time.</p>
<h2>If the collection may grow</h2>
<p>If you expect the collection to outgrow a single cabinet, say that in the <a href="{$contact}">first enquiry</a>. The studio can combine a Swisscave fridge with <a href="{$racking}">racking</a> so the cabinet handles daily bottles and the wall holds the rest. Adding the racking later is harder if the wall was never planned for it.</p>
HTML,
		],
	];
}

function cellar_studio_blog_queue_content(array $item): string {
	$html = $item['body'];
	if (!empty($item['faqs']) && is_array($item['faqs'])) {
		$html .= '<h2>Common questions</h2>';
		foreach ($item['faqs'] as $faq) {
			$html .= '<h3>' . esc_html($faq['q']) . '</h3>';
			$html .= '<p>' . esc_html($faq['a']) . '</p>';
		}
	}
	return $html;
}

function cellar_studio_publish_next_queued_post(): void {
	if (wp_doing_ajax() || wp_installing() || (defined('REST_REQUEST') && REST_REQUEST)) {
		return;
	}
	if (get_transient('cellar_studio_blog_queue_lock')) {
		return;
	}
	set_transient('cellar_studio_blog_queue_lock', 1, MINUTE_IN_SECONDS);

	$last = (int) get_option('cellar_studio_blog_queue_last', 0);
	if ($last > 0 && (time() - $last) < (2 * DAY_IN_SECONDS)) {
		return;
	}

	$queue = cellar_studio_blog_queue();
	$index = (int) get_option('cellar_studio_blog_queue_index', 0);
	if (!isset($queue[$index])) {
		return;
	}

	$item = $queue[$index];
	$existing = get_page_by_path($item['slug'], OBJECT, 'post');
	if ($existing instanceof WP_Post) {
		update_option('cellar_studio_blog_queue_index', $index + 1, false);
		return;
	}

	$post_id = wp_insert_post([
		'post_type' => 'post',
		'post_status' => 'publish',
		'post_title' => $item['title'],
		'post_name' => $item['slug'],
		'post_excerpt' => $item['excerpt'],
		'post_content' => cellar_studio_blog_queue_content($item),
		'post_author' => 1,
	], true);

	if (is_wp_error($post_id) || !$post_id) {
		return;
	}

	if (!empty($item['faqs'])) {
		update_post_meta($post_id, 'cellar_llm_faq', wp_json_encode($item['faqs']));
	}
	update_option('cellar_studio_blog_queue_index', $index + 1, false);
	update_option('cellar_studio_blog_queue_last', time(), false);
}
add_action('init', 'cellar_studio_publish_next_queued_post', 30);
