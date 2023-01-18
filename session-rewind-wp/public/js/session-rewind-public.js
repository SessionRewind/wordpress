if (sessionRewindOptions && sessionRewindOptions.apiKey) {
	!function (o) {
		var w = window;
		w.SessionRewindConfig = o;
		var f = document.createElement("script");
		f.async = 1, f.crossOrigin = "anonymous",
			f.src = "https://rec.sessionrewind.com/srloader.js";
		var g = document.getElementsByTagName("head")[0];
		g.insertBefore(f, g.firstChild);
	}(sessionRewindOptions);
} else {
	console.warn('Session Rewind WP plugin is not configured!')
}
