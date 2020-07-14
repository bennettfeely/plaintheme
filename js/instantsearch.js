console.log(lists);

new Autocomplete("#autocomplete", {
	autoSelect: true,
	search: (input) => {
		if (input.length > 0) {
			var filtered = lists.filter((list) => {
				match = false;
				list.keywords.forEach((keyword) => {
					var queryable = keyword.startsWith(input.toLowerCase());

					if (queryable == true) {
						match = true;
					}
				});

				return match;
			});

			return filtered;
		}
		return [];
	},
	getResultValue: (result) => result.title,
	renderResult: (result, props) => `
	    <a class="instant-list-link" href="${result.href}" ${props}>
			<span class="list-link-title">${result.title}</span>
			<span class="list-link-length"> (${result.length})</span>
		</a>
	  `,
	onSubmit: (result) => {
		// Hide the keyboard on touchscreens
		document.activeElement.blur();

		// Open the link
		window.location.href = encodeURI(result.href);
	},
});
