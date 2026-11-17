<?php
if (!defined('ABSPATH')) {
	exit;
}

$cellar_mailer_url = function_exists('cellar_studio_mailer_endpoint')
	? cellar_studio_mailer_endpoint()
	: admin_url('admin-ajax.php?action=cellar_studio_mailer');

$cellar_bespoke_thank_you = home_url('/thank-you-bespoke/');
?>

<footer class="site-footer">
	<div class="container-fluid">
		<div class="footer-top d-flex flex-column flex-lg-row justify-content-between gap-4">
			<div class="footer-brand">
				<div class="footer-logo-placeholder">
					<img src="<?php echo esc_url(cellar_studio_asset('img/logo-black.svg')); ?>" alt="logo" class="footer-logo-img">
				</div>
				<p class="footer-tagline mb-0">
					Exclusive Wine &amp; Cigar Spaces
				</p>
				<p class="footer-nap mb-0">
					Swiss Tower, Cluster Y, Jumeirah Lakes Towers, Dubai<br>
					<a href="tel:+971509124567">+971 50 912 4567</a>
					·
					<a href="mailto:sacha@cellar-studio.com">sacha@cellar-studio.com</a><br>
					Monday–Saturday, 08:00 AM – 09:00 PM
				</p>
			</div>

			<div class="footer-columns row g-3 g-lg-4">
				<div class="col-6 col-lg-3">
					<h6 class="footer-column-title">Solutions</h6>
					<ul class="footer-links list-unstyled mb-0">
						<li><a href="<?php echo esc_url(home_url('/wine-racking-solutions/')); ?>">Wine racking</a></li>
						<li><a href="<?php echo esc_url(home_url('/cigar-humidors/')); ?>">Cigar rooms</a></li>
						<li><a href="<?php echo esc_url(home_url('/bespoke/')); ?>">Bespoke projects</a></li>
					</ul>
				</div>

				<div class="col-6 col-lg-3">
					<h6 class="footer-column-title">Company</h6>
					<ul class="footer-links list-unstyled mb-0">
						<li><a href="<?php echo esc_url(home_url('/about/')); ?>">About</a></li>
						<li><a href="<?php echo esc_url(home_url('/')); ?>">Projects</a></li>
						<li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a></li>
					</ul>
				</div>
				<div class="col-6 col-lg-3">
					<h6 class="footer-column-title">Follow Us</h6>
					<ul class="footer-links list-unstyled mb-0">
						<li><a href="https://www.instagram.com/cellarstudiouae/" target="_blank" rel="noopener">Instagram</a></li>
						<li><a href="https://www.linkedin.com/company/cellar-studio-uae/" target="_blank" rel="noopener">LinkedIn</a></li>
						<li><a href="https://api.whatsapp.com/send/?phone=971509124567" target="_blank" rel="noopener">WhatsApp</a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="footer-bottom d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center mt-4 pt-3">
			<p class="footer-copy mb-2 mb-lg-0">
				&copy; <?php echo esc_html(date('Y')); ?> Cellar Studio. All rights reserved.
			</p>
			<div class="footer-bottom-links d-flex flex-wrap gap-3">
				<a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">Privacy Policy</a>
				<a href="<?php echo esc_url(home_url('/terms-and-conditions/')); ?>">Terms &amp; Conditions</a>
			</div>
		</div>
	</div>
</footer>

<div class="modal fade portfolio-modal" id="portfolioModal" tabindex="-1" aria-labelledby="portfolioModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content portfolio-modal-content">
			<button type="button" class="btn-close portfolio-modal-close" data-bs-dismiss="modal" aria-label="Close"></button>

			<div class="portfolio-modal-body">
				<div class="portfolio-modal-left">
					<p class="portfolio-modal-kicker" id="portfolioModalLocation">Al Barari, Dubai, UAE</p>
					<h2 class="portfolio-modal-title" id="portfolioModalLabel">Under-Stair Wine &amp; Cigar Installation</h2>
					<p class="portfolio-modal-text" id="portfolioModalText">
						A bespoke under-stair wine and cigar installation in Al Barari, designed as a refined interior feature where craftsmanship and climate control work together. Warm timber, clean metal detailing, and integrated lighting present the collection with gallery-like clarity while keeping humidity stable for daily use.
					</p>
				</div>

				<div class="portfolio-modal-right">
					<div class="portfolio-modal-image-wrap">
						<img id="portfolioModalMainImage" src="<?php echo esc_url(cellar_studio_asset('img/Projects.png')); ?>" alt="Project image" class="portfolio-modal-image">
					</div>

					<div class="portfolio-modal-thumbs" id="portfolioModalThumbs" aria-label="Project thumbnails">
						<button type="button" class="portfolio-modal-thumb is-active" data-thumb-src="<?php echo esc_url(cellar_studio_asset('img/Projects.png')); ?>" aria-label="Thumbnail 1">
							<img src="<?php echo esc_url(cellar_studio_asset('img/Projects.png')); ?>" alt="">
						</button>
						<button type="button" class="portfolio-modal-thumb" data-thumb-src="<?php echo esc_url(cellar_studio_asset('img/Projects.png')); ?>" aria-label="Thumbnail 2">
							<img src="<?php echo esc_url(cellar_studio_asset('img/Projects.png')); ?>" alt="">
						</button>
						<button type="button" class="portfolio-modal-thumb" data-thumb-src="<?php echo esc_url(cellar_studio_asset('img/Projects.png')); ?>" aria-label="Thumbnail 3">
							<img src="<?php echo esc_url(cellar_studio_asset('img/Projects.png')); ?>" alt="">
						</button>
						<button type="button" class="portfolio-modal-thumb" data-thumb-src="<?php echo esc_url(cellar_studio_asset('img/Projects.png')); ?>" aria-label="Thumbnail 4">
							<img src="<?php echo esc_url(cellar_studio_asset('img/Projects.png')); ?>" alt="">
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<a
	href="https://api.whatsapp.com/send/?phone=971509124567"
	class="whatsapp-fab is-visible"
	id="whatsappFab"
	target="_blank"
	rel="noopener"
	aria-label="Chat on WhatsApp"
>
	<img src="<?php echo esc_url(cellar_studio_asset('img/WhatsApp_icon.png')); ?>" alt="" class="whatsapp-fab-icon">
</a>


<script>
document.addEventListener("DOMContentLoaded", function () {
	function cellarPageLabel() {
		var path = (window.location.pathname || "/").replace(/\/+$/, "");
		var parts = path.split("/").filter(Boolean);
		var productAt = parts.indexOf("product");
		if (productAt >= 0 && parts[productAt + 1]) {
			return "Product " + decodeURIComponent(parts[productAt + 1]);
		}
		var labels = {
			"bespoke": "Bespoke",
			"wine-fridge": "Wine Fridge",
			"cigar-humidors": "Cigar Humidors",
			"wine-racking-solutions": "Wine Racking",
			"contact": "Contact",
			"about": "About",
			"shop": "Shop",
			"blog": "Blog"
		};
		for (var i = parts.length - 1; i >= 0; i--) {
			if (labels[parts[i]]) return labels[parts[i]];
		}
		if (!parts.length) return "Home";
		var last = parts[parts.length - 1];
		if (last.indexOf(".") !== -1) return "Home";
		return decodeURIComponent(last).replace(/-/g, " ");
	}

	function cellarReadUtm() {
		var params = new URLSearchParams(window.location.search);
		var fromUrl = {
			utm_source: (params.get("utm_source") || "").slice(0, 120),
			utm_medium: (params.get("utm_medium") || "").slice(0, 120),
			utm_campaign: (params.get("utm_campaign") || "").slice(0, 120)
		};
		var saved = null;
		try {
			saved = JSON.parse(sessionStorage.getItem("cellarUtm") || "null");
		} catch (e) {
			saved = null;
		}
		var utm = {
			utm_source: fromUrl.utm_source || (saved && saved.utm_source) || "",
			utm_medium: fromUrl.utm_medium || (saved && saved.utm_medium) || "",
			utm_campaign: fromUrl.utm_campaign || (saved && saved.utm_campaign) || ""
		};
		if (fromUrl.utm_source || fromUrl.utm_medium || fromUrl.utm_campaign) {
			try {
				sessionStorage.setItem("cellarUtm", JSON.stringify(utm));
			} catch (e) {}
		}
		return utm;
	}

	function cellarApplyWhatsapp(link, utm) {
		var href = link.getAttribute("href") || "";
		if (!/whatsapp\.com|wa\.me/i.test(href)) return;
		var url;
		try {
			url = new URL(href, window.location.href);
		} catch (e) {
			return;
		}
		if ((url.searchParams.get("text") || "").trim()) return;
		var lines = [
			"Hello Cellar Studio, I am enquiring from the " + cellarPageLabel() + " page.",
			"Page: " + window.location.href.split("#")[0]
		];
		var bits = [utm.utm_source, utm.utm_medium, utm.utm_campaign].filter(Boolean);
		if (bits.length) lines.push("Source: " + bits.join(" / "));
		url.searchParams.set("text", lines.join("\n"));
		link.setAttribute("href", url.toString());
	}

	function cellarFillUtm(form, utm) {
		["utm_source", "utm_medium", "utm_campaign"].forEach(function (name) {
			var input = form.querySelector('input[name="' + name + '"]');
			if (!input) {
				input = document.createElement("input");
				input.type = "hidden";
				input.name = name;
				form.appendChild(input);
			}
			input.value = utm[name] || "";
		});
	}

	var utm = cellarReadUtm();
	document.querySelectorAll('a[href*="whatsapp.com"], a[href*="wa.me"]').forEach(function (link) {
		cellarApplyWhatsapp(link, utm);
	});
	document.querySelectorAll("form.js-mailer-form").forEach(function (form) {
		cellarFillUtm(form, utm);
	});

	document.addEventListener("click", function (event) {
		var link = event.target && event.target.closest ? event.target.closest("a") : null;
		if (!link) return;
		var href = link.getAttribute("href") || "";
		var eventName = "";
		if (/whatsapp\.com|wa\.me/i.test(href)) {
			cellarApplyWhatsapp(link, cellarReadUtm());
			href = link.getAttribute("href") || href;
			eventName = "whatsapp_click";
		} else if (/^tel:/i.test(href)) {
			eventName = "phone_click";
		} else if (/^mailto:/i.test(href)) {
			eventName = "email_click";
		}
		if (!eventName) return;
		var currentUtm = cellarReadUtm();
		window.dataLayer = window.dataLayer || [];
		window.dataLayer.push({
			event: eventName,
			link_url: href,
			page_path: window.location.pathname,
			page_location: window.location.href.split("#")[0],
			page_label: cellarPageLabel(),
			utm_source: currentUtm.utm_source,
			utm_medium: currentUtm.utm_medium,
			utm_campaign: currentUtm.utm_campaign
		});
	}, true);
});
</script>

<script>
window.cellarStudioThankYouUrl = <?php echo wp_json_encode(home_url('/thank-you/')); ?>;
window.cellarStudioBespokeThankYouUrl = <?php echo wp_json_encode($cellar_bespoke_thank_you); ?>;
window.cellarStudioBespokeEnquiryUrl = <?php echo wp_json_encode(home_url('/bespoke/#bespoke-enquiry')); ?>;
window.cellarStudioContactUrl = <?php echo wp_json_encode(home_url('/contact/')); ?>;
window.cellarStudioMailerUrl = <?php echo wp_json_encode($cellar_mailer_url); ?>;
window.cellarStudioMetaPixelId = <?php echo wp_json_encode(CELLAR_STUDIO_META_PIXEL_ID); ?>;

document.addEventListener("DOMContentLoaded", function () {
	var thankYouUrl = window.cellarStudioThankYouUrl || "/thank-you/";
	var pixelId = window.cellarStudioMetaPixelId || "1695884918273232";

	function cellarMetaDigits(value) {
		return String(value || "").replace(/\D+/g, "");
	}

	function cellarMetaLeadCategory(form, destUrl) {
		var sourceEl = form.querySelector('[name="source"]');
		var source = sourceEl ? String(sourceEl.value || "").trim() : "";
		var dest = String(destUrl || "");
		if (/wine fridge/i.test(source) || /thank-you-wine-fridge/i.test(dest)) {
			return "Wine Fridge";
		}
		if (/cigar/i.test(source) || /thank-you-cigar/i.test(dest)) {
			return "Cigar Humidor";
		}
		if (/^bespoke$/i.test(source) || /thank-you-bespoke/i.test(dest) || /\/bespoke\/?$/i.test(window.location.pathname)) {
			return "Bespoke Lead";
		}
		return "";
	}

	function cellarMetaPrepareLead(form, destUrl) {
		var emailEl = form.querySelector('[name="email"]');
		var phoneEl = form.querySelector('[name="phone"]');
		var prefixEl = form.querySelector('[name="phone_prefix"]');
		var email = emailEl ? String(emailEl.value || "").trim().toLowerCase() : "";
		var phone = cellarMetaDigits((prefixEl ? prefixEl.value : "") + (phoneEl ? phoneEl.value : ""));
		var category = cellarMetaLeadCategory(form, destUrl);
		if (category === "Bespoke Lounge") {
			category = "";
		}
		var payload = { em: email, ph: phone, category: category };

		try {
			sessionStorage.setItem("cellarMetaLead", JSON.stringify(payload));
			sessionStorage.removeItem("cellarMetaLeadFired");
		} catch (e) {}

		if (typeof fbq !== "function") {
			return;
		}

		var userData = {};
		if (email) userData.em = email;
		if (phone) userData.ph = phone;
		if (userData.em || userData.ph) {
			fbq("init", pixelId, userData);
		}
	}

	document.querySelectorAll("form.js-mailer-form").forEach(function (form) {
		form.addEventListener("submit", function (e) {
			e.preventDefault();

			var mailerUrl = form.getAttribute("action") || window.cellarStudioMailerUrl;
			if (!mailerUrl || /mailer\.php/i.test(mailerUrl)) {
				mailerUrl = window.cellarStudioMailerUrl;
			}
			var formThankYouUrl = form.getAttribute("data-thank-you") || thankYouUrl;
			if (!form.getAttribute("data-thank-you") && /\/bespoke\/?$/i.test(window.location.pathname)) {
				formThankYouUrl = window.cellarStudioBespokeThankYouUrl || "/thank-you-bespoke/";
			}
			var statusEl =
				form.querySelector(".consultation-modal-status") ||
				form.querySelector(".contact-form-status");

			if (statusEl) {
				statusEl.textContent = "Sending…";
				statusEl.classList.add("is-visible", "is-success");
				statusEl.classList.remove("is-error");
			}

			var fd = new FormData(form);
			fd.set("page", window.location.pathname);

			fetch(mailerUrl, {
				method: "POST",
				body: fd,
				credentials: "same-origin"
			})
				.then(function (res) {
					return res.text().then(function (text) {
						var payload = null;
						try {
							payload = JSON.parse(text);
						} catch (err) {
							payload = null;
						}

						if (payload && payload.success) {
							cellarMetaPrepareLead(form, formThankYouUrl);
							window.location.replace(formThankYouUrl);
							return;
						}

						if (res.ok && /email sent successfully/i.test(text)) {
							cellarMetaPrepareLead(form, formThankYouUrl);
							window.location.replace(formThankYouUrl);
							return;
						}

						var errorMessage = "Could not send. Please try again.";
						if (payload && payload.data && payload.data.message) {
							errorMessage = payload.data.message;
						} else if (text) {
							errorMessage = text;
						}

						throw new Error(errorMessage);
					});
				})
				.catch(function (err) {
					var message = (err && err.message) ? err.message : "Could not send. Please try again.";
					if (statusEl) {
						statusEl.textContent = message;
						statusEl.classList.add("is-visible", "is-error");
						statusEl.classList.remove("is-success");
					} else if (window.jQuery && jQuery.notify) {
						jQuery.notify(message, "error");
					}
				});
		});
	});
});
</script>