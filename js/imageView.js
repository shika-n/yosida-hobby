const imageView = document.getElementById("imageView");
const images = document.getElementsByTagName("img");

function toggleImageView() {
	imageView.classList.toggle("scale-0");
	imageView.classList.toggle("backdrop-blur-none");
	imageView.classList.toggle("backdrop-blur-md");
	imageView.classList.toggle("bg-black/20");
	imageView.classList.toggle("bg-none");
}

for (img of images) {
	img.addEventListener("click", (e) => {
		toggleImageView();
		imageView.setAttribute("src", e.target.getAttribute("src"));
	});
}

window.addEventListener("keydown", (e) => {
	if (e.key == "Escape") {
		if (!imageView.classList.contains("scale-0")) {
			toggleImageView();
		}
	}
});
