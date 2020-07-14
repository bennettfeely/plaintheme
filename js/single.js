var html = document.querySelector("html");
var content_list_wrapper = document.querySelector(".content-list-wrapper");
var content_list = document.querySelector(".content-list");

// Copy list button
if (ClipboardJS.isSupported()) {
	var clipboard = new ClipboardJS(".copy-button");

	clipboard.on("success", function (e) {
		flash(".content-list");

		document.querySelector(".copy-button").innerHTML = "List copied!";

		setTimeout(function () {
			document.querySelector(".copy-button").innerHTML =
				"Copy list to clipboard";
		}, 2000);
	});

	clipboard.on("error", function (e) {
		console.log(e);

		setTimeout(function () {
			document.querySelector(".copy-button").innerHTML =
				"Error copying list";
		}, 2000);
	});
}

// Sort list
function listSort(order) {
	flash(".sort-" + order);

	if (order == "default") {
		// Sort items by the default [data-order="#"]
		tinysort(".content-item", {
			order: "asc",
			attr: "data-order",
		});
	} else {
		// Sort items another way
		tinysort(".content-item", {
			order: order,
			natural: true,
		});
	}
}

// Toggle list settings
function listStyle(list_style) {
	flash(".style-" + list_style);

	if (list_style == "default") {
		loopListStyle("div", "div", list_style);
	}

	if (list_style == "bullets") {
		loopListStyle("ul", "li", list_style);
	}

	if (list_style == "numbers") {
		loopListStyle("ol", "li", list_style);
	}
}

// Change list structure
function loopListStyle(parent_tag, child_tag, list_style) {
	var content_items = document.querySelectorAll(".content-item");

	var new_parent = document.createElement(parent_tag);
	new_parent.className = "content-list " + list_style;

	content_list_wrapper.innerHTML = "";
	content_list_wrapper.appendChild(new_parent);

	content_items.forEach((content_item) => {
		var new_item = document.createElement(child_tag);
		new_item.className = "content-item";

		var text_content = content_item.innerHTML;
		var default_case = content_item.getAttribute("data-default-case");
		var default_order = content_item.getAttribute("data-default-order");

		new_item.innerHTML = text_content;
		new_item.setAttribute("data-default-order", default_order);
		new_item.setAttribute("data-default-case", default_case);

		new_parent.appendChild(new_item);
	});
}

// Change list case
function listCase(list_case) {
	flash(".case-" + list_case);

	var content_items = document.querySelectorAll(".content-item");

	if (list_case == "default") {
		content_items.forEach((content_item) => {
			var default_case = content_item.getAttribute("data-default-case");
			content_item.innerHTML = default_case;
		});
	}

	if (list_case == "uppercase") {
		content_items.forEach((content_item) => {
			var default_case = content_item.getAttribute("data-default-case");
			content_item.innerHTML = default_case.toUpperCase();
		});
	}

	if (list_case == "lowercase") {
		content_items.forEach((content_item) => {
			var default_case = content_item.getAttribute("data-default-case");
			content_item.innerHTML = default_case.toLowerCase();
		});
	}
}

// Trigger animation
function flash(elem) {
	document.querySelector(elem).classList.add("flash");

	setTimeout(function () {
		document.querySelector(elem).classList.remove("flash");
	}, 300);
}

// Show comment form
var comment_toggle_button = document.querySelector(".comment-toggle-button");
var comment_form = document.querySelector(".comment-form");
var comment_textarea = document.querySelector(".comment-textarea");
var comment_submit = document.querySelector(".comment-submit");
var comment_submit_button = document.querySelector(".comment-submit-button");
var comment_spinner = document.querySelector(
	".comment-spinner-wrapper .spinner"
);
var comment_preview = document.querySelector(".comment-preview");
var comment_status = document.querySelector(".comment-status");

if (document.body.contains(comment_toggle_button)) {
	comment_toggle_button.addEventListener("click", function () {
		hide(comment_toggle_button);
		show(comment_form);

		comment_textarea.focus();
	});

	comment_submit_button.addEventListener("click", function () {
		comment_submit_button.value = "Sending...";

		show(comment_spinner);
	});

	// Handle ajax submitted comments
	comment_form.addEventListener("submit", function (e) {
		e.preventDefault();

		var url = "/wp-comments-post.php";
		var request = new XMLHttpRequest();
		request.open("POST", url, true);
		request.onload = function () {
			console.log(request);

			// Copy comment text to preview div and hide the textarea
			var comment_text = document.querySelector(".comment-textarea")
				.value;
			comment_preview.innerHTML = comment_text;
			hide(comment_textarea);

			hide(comment_submit);

			comment_status.innerHTML =
				"<strong>Thank you!</strong> Your suggestion has been successfully sent and will be considered in any changes to this list.";
			show(comment_status);
		};
		request.onerror = function (error) {
			console.log(error);

			comment_textarea.disabled = true;
			hide(comment_submit);

			comment_status.innerHTML =
				"<strong>Oh no.</strong> Something went wrong and your suggestion could not be sent. We are investigating this issue.";
			show(comment_status);
		};

		request.send(new FormData(e.target));
	});
}

function hide(elem) {
	elem.style.display = "none";
}

function show(elem) {
	elem.style.display = "block";
}
