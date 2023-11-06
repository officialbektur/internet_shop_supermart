/* ===================================  Preloader  --Start--  =================================== */
window.onload = function() {
	if (document.querySelector(".preloader")) {
		let preloader = document.querySelector(".preloader");
		let screenWidth = screen.width;
		let numberDefault = Number(window.getComputedStyle(document.documentElement).getPropertyValue("font-size").match(/\d+/)[0]);
		let emSreenWidth = screenWidth / numberDefault;
		if (300 / 16 <= emSreenWidth) {
			document.documentElement.classList.add("lock");
			document.querySelector(".wrapper").classList.add("_done");
			window.setTimeout((function() {
				if (!preloader.classList.contains("_show")) {
					document.querySelector(".wrapper").classList.remove("_done");
					setTimeout((() => {
						preloader.classList.add("_show");
						document.documentElement.classList.remove("lock");
					}), 100);
				}
			}), 3e3);
		} else {
			document.querySelector(".wrapper").classList.remove("_done");
			preloader.classList.add("_show");
			document.documentElement.classList.remove("lock");
		}
	}
};
/* ===================================  Preloader  --End--  =================================== */