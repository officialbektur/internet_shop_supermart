<template>
	<img ref="image" :src="src" v-if="alt" :alt="alt" />
	<img ref="image" :src="src" v-else>
</template>

<script>
	export default {
		name: 'VueMagnify',
		props: {
			src: {
				type: [String, Object],
			},
			alt: {
				type: String,
				default: null,
			},
		},
		data() {
		},
		mounted() {
			this.magnify();
		},
		updated() {
		},
		methods: {
			magnify() {
				if (document.documentElement.classList.contains("_pc")) {
					let zoom = 1.3;
					let image = this.$refs[`image`];

					let glass = document.createElement("DIV");
					glass.setAttribute("class", "img-magnifier-glass");
					image.parentElement.insertBefore(glass, image);
					glass.style.backgroundImage = "url('" + image.src + "')";
					glass.style.backgroundRepeat = "no-repeat";
					glass.style.backgroundSize = image.width * zoom + "px " + image.height * zoom + "px";

					let bw = 3;
					let w = glass.offsetWidth / 2;
					let h = glass.offsetHeight / 2;

					glass.addEventListener("mousemove", moveMagnifier);
					image.addEventListener("mousemove", moveMagnifier);
					glass.addEventListener("mouseout", mouseOutImg);

					function moveMagnifier(e) {
						var pos, x, y;
						e.preventDefault();
						pos = getCursorPos(e);
						x = pos.x;
						y = pos.y;
						if (x > image.width - w / zoom) x = image.width - w / zoom;
						if (x < w / zoom) x = w / zoom;
						if (y > image.height - h / zoom) y = image.height - h / zoom;
						if (y < h / zoom) y = h / zoom;
						glass.classList.add("_cursor");
						glass.style.left = x - w + "px";
						glass.style.top = y - h + "px";
						glass.style.backgroundPosition = "-" + (x * zoom - w + bw) + "px -" + (y * zoom - h + bw) + "px";
					}
					function getCursorPos(e) {
						var a, x = 0, y = 0;
						e = e || window.event;
						a = image.getBoundingClientRect();
						x = e.pageX - a.left;
						y = e.pageY - a.top;
						x -= window.pageXOffset;
						y -= window.pageYOffset;
						return { x, y };
					}
					function mouseOutImg() {
						glass.classList.remove("_cursor");
					}
				}
			}
		},
		computed: {},
		components: {},
	};
</script>
