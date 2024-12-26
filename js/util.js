function toRad(degree) {
	return Math.PI * degree / 180;
}

function toDegree(radian) {
	return 180 * radian / Math.PI;
}

function clearScreen(imageData) {
	for (let i = 0; i < SCREEN_WIDTH * SCREEN_HEIGHT; ++i) {
		imageData.data[i * 4] = 0;
		imageData.data[i * 4 + 1] = 0;
		imageData.data[i * 4 + 2] = 0;
	}
}

function putPixel(imageData, pixelIndex, r, g, b) {
	imageData.data[pixelIndex    ] = r;
	imageData.data[pixelIndex + 1] = g;
	imageData.data[pixelIndex + 2] = b;
}

function linearMix(valA, valB, mix) {
	return valA + valB * mix;
}

class Vector {
	constructor(x, y, z) {
		this.x = x;
		this.y = y;
		this.z = z;
	}

	getLength() {
		return Math.sqrt(this.x * this.x + this.y * this.y + this.z * this.z);
	}
}
