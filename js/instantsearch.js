var search_form_wrapper = document.querySelector(".search-form-wrapper");
var search_instant_results = document.querySelector(".search-instant-results");
var search_input = document.querySelector(".search-input");
list_length = 0;
current_index = 0;
// -1 = [data-instant-index="list_length"]
// 0 = input
// 1 = [data-instant-index="1"]
// 2 = [data-instant-index="2"] ...

function instantSearch() {
	search_instant_results.innerHTML = "";
	var search_value = document.querySelector(".search-input").value;

	if (search_value.length >= 2) {
		// Display search loading indicator
		search_form_wrapper.classList.add("is-loading-instant-search");

		instantSearchRequest();
	}
}

var instantSearchRequest = debounce(function () {
	var search_value = document.querySelector(".search-input").value;
	var encoded = encodeURIComponent(search_value).replace(/%20/g, "+");
	var search = "?instant_s=" + encoded;
	var url = "https://copypastelist.com/instant-search/" + search;

	nanoajax.ajax({ url: url }, function (code, response) {
		console.log("code: " + code);

		if (code == 200) {
			// Hide search loading indicator
			search_form_wrapper.classList.remove("is-loading-instant-search");

			// Clear the search results
			search_instant_results.innerHTML = "";
			current_index = 0;

			// Add search results
			search_instant_results.innerHTML = response;
		}
	});
}, 300);

function debounce(func, wait, immediate) {
	var timeout;
	return function () {
		var context = this,
			args = arguments;
		var later = function () {
			timeout = null;
			if (!immediate) func.apply(context, args);
		};
		var callNow = immediate && !timeout;
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
		if (callNow) func.apply(context, args);
	};
}

// Handle up/down keys
search_input.addEventListener("keydown", function (e) {
	var index_list = document.querySelector(".instant-index-list");

	if (document.body.contains(index_list)) {
		// We have search results. Let's do something then
		countListItems();

		// Down keydown
		if (e.keyCode == 40) {
			if (current_index < list_length) {
				current_index++;
			} else {
				if (current_index == list_length) {
					current_index = 1;
				}
			}
		}

		// Up keydown
		if (e.keyCode == 38) {
			if (current_index >= 0) {
				current_index--;
			}

			// Highlight last item to loop going upwards
			if (current_index == -1) {
				current_index = list_length;
			}

			// If index is more than number of list items which
			// could happen if window is resized vertically
			if (current_index > list_length) {
				current_index = list_length;
			}
		}

		// Add .is-highlighted to current index item
		highlightCurrentIndex();

		// Enter/Return keydown
		if (e.keyCode == 13) {
			// Prevent blocking a hard search if we aren't highling a list item
			if (current_index > 0) {
				// Prevent form from being submitted
				e.preventDefault();

				// Simulate click on current item
				var current_item =
					'[data-instant-index="' + current_index + '"]';
				document.querySelector(current_item).click();
			}
		}
	} else {
		// We don't have search results. Reset the index
		list_length = 0;
		current_index = 0;
	}
});

function countListItems() {
	// Count only visible list items returned
	list_length = 0;
	var li_list_items = document.querySelectorAll(
		".instant-index-list .list-item"
	);

	// Check if list item is visible
	li_list_items.forEach((li_list_item) => {
		if (window.getComputedStyle(li_list_item).display !== "none") {
			list_length++;
		}
	});

	highlightCurrentIndex();
}

function forceCurrentIndex(new_index) {
	countListItems();

	current_index = new_index;

	highlightCurrentIndex();
}

function highlightCurrentIndex() {
	var index_list = document.querySelector(".instant-index-list");
	if (document.body.contains(index_list)) {
		console.log("current_index: " + current_index + "/" + list_length);

		// Remove .is-highlighted class from any list links
		var highlighted_item = document.querySelector(
			".instant-index-list .is-highlighted"
		);
		if (highlighted_item !== null) {
			highlighted_item.classList.remove("is-highlighted");
		}

		if (current_index > 0) {
			// Add .is-highlighted to current index item
			var current_item = document.querySelector(
				'[data-instant-index="' + current_index + '"]'
			);
			current_item.classList.add("is-highlighted");
		}
	}
}
