function openGame(url, winW, winH) {
	window.open(url,
				"html_name" + wn++,
				"width=" + winW + ",height=" + winH);
}

wn = 0;

function openKeys(url) {
	window.open(url,
				window.name+'keys',
				'width=400,height=300,scrollbars=yes');
}

function openPerson(url) {
	window.open(url,
				'personwindow',
				'width=600,height=400,scrollbars=yes');
}